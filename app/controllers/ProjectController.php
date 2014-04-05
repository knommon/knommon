<?php

class ProjectController extends Controller {

	public function __construct() {
		// the user must be a member of the project to perform any action except view, create & store
		$this->beforeFilter('auth.access:project', array('except' => array('index', 'show', 'create', 'store')));
		// must be logged in to create/store a new project
		$this->beforeFilter('auth', array('only' => array('create', 'store')));
	}

	/**
	 * Display a listing of the project.
	 */
	public function index() {
		$projects = Project::orderBy('updated_at', 'desc')->get();
		return View::make('project/index', compact('projects'));
	}

	/**
	 * Show the form for creating a new project.
	 */
	public function create() {
		return View::make('project/create');
	}

	/**
	 * Store a newly created project in storage.
	 * @method POST
	 * @precondition user is logged in
	 */
	public function store() {
		return $this->attemptEdit(new Project(), true);
	}

	/**
	 * Display the specified project.
	 * @param int $id project id
	 */
	public function show($id, $slug = null)
	{
		$project = Project::findOrFail($id);

		// force slugs on URLs
		if ($slug == null || $project->slug !== $slug) {
			return Redirect::route('project.show', array('id' => $project->id, 'slug' => $project->slug), 301);
		}

		$team = $project->users()->get();
		$follows = $isMember = false;

		if (Auth::check()) {
			$user = Auth::user();
			$team->contains($user);
			$isMember = $team->contains($user->id);

			if (!$isMember) {
				$follows = $user->isFollowing($project->id);
			}
		}
		
		return View::make('project/show', array(
			'project' => $project, 
			'team' => $team,
			'isMember' => $isMember,
			'follows' => $follows,
			'tags' => $project->tagged()->get(),
		));
	}

	/**
	 * Show the form for editing the specified project.
	 */
	public function edit($id)
	{
		$project = Project::findOrFail($id);
		return View::make('project/edit', compact('project'));
	}

	/**
	 * Update the specified project in storage.
	 * @method PUT
	 */
	public function update($id)
	{
		$project = Project::findOrFail($id);
		return $this->attemptEdit($project, false);
	}

	/**
	 * Show the project delete confirmation page.
	 */
	public function confirm($id)
	{
		$project = Project::findOrFail($id);
		return View::make('project/delete', compact('project'));
	}

	/**
	 * @todo: make this a soft delete and just hide the project?
	 * Remove the specified project from storage.
	 * @method DELETE
	 */
	public function destroy($id)
	{
		$project = Project::findOrFail($id);
		$project->delete();

		return Redirect::action('ProjectController@index')
			->with('status', "Project {$project->title} successfully deleted!");
	}

	/**
	 * @todo: sanitize input
	 * @todo: delete tags that no longer matter
	 * Attemps to commit the edits on the project in Input, or returns to fail action
	 * @param  Project $project    The project resource to modify
	 * @param  boolean $create     If we're creating, false for editing
	 */
	protected function attemptEdit(Project $project, $create = false)
	{
		$validator = Validator::make(Input::all(), ['title' => 'required', 'tagline' => 'required']);

		if ($validator->fails()) {
			$redirect = ($create) ? Redirect::action('ProjectController@create') : Redirect::action('ProjectController@edit', $project->id);
			return $redirect->withInput(Input::all())->withErrors($validator);
		}
		
		$project->title = e(Input::get('title'));
		$project->tagline = e(Input::get('tagline'));
		$project->about = e(Input::get('about'));

		$user = Auth::user();
		
		if ($create) {
			$project->user_id = $user->id;
		}

		$project->save();

		if ($create) {
			// add this user as a member of the project
			$user->join($project->id);
		}

		//cycle through comma separated tag input and add the new tags and associate all the tags
		$tags = explode(",", Input::get('tags'));

		//is there a way to do this better? 
		foreach ($tags as $tagname) {
			$project->tag($tagname);
		}

		return Redirect::action('ProjectController@show', $project->id)
			->with('status', "Project " . ($create ? 'created' : 'updated') . " successfully!");
	}
}
