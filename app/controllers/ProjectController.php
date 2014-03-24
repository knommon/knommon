<?php

/**
 * @todo: add user permissions for Projects
 */
class ProjectController extends Controller {

	public function __construct() {
		// for the user to be logged in to perform any action except view
		$this->beforeFilter('auth', array('except' => array('index', 'show')));
	}

	/**
	 * Display a listing of the project.
	 */
	public function index() {
		$projects = Project::all();
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
	public function show($id)
	{
		$project = Project::findOrFail($id);
		return View::make('project/show', compact('project'));
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
	 * Attemps to commit the edits on the project in Input, or returns to fail action
	 * @param  Project $project    The project resource to modify
	 * @param  boolean $create     If we're creating, false for editing
	 */
	protected function attemptEdit(Project $project, $create = false)
	{
		$validator = Validator::make(Input::all(), ['title' => 'required', 'about' => 'required']);

		if ($validator->fails()) {
			$redirect = ($create) ? Redirect::action('ProjectController@create') : Redirect::action('ProjectController@edit', $project->id);
			return $redirect->withInput(Input::all())->withErrors($validator);
		}

		$project->title = Input::get('title');
		$project->about = e(Input::get('about'));
		
		if ($create) {
			$project->user_id = Auth::user()->id;
		}

		$project->save();
		
		return Redirect::action('ProjectController@show', $project->id)
			->with('status', "Project {$project->name} " . ($create ? 'created' : 'updated') . " successfully!");
	}
}
