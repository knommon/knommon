<?php

use Illuminate\Database\QueryException;

class ResourceController extends Controller {

	public function __construct() {
		// for the user to be logged & a member of the project that the resource belongs to except for viewing it
		$this->beforeFilter('auth.access:resource', array('except' => array('index', 'show', 'create', 'store')));
		//must be logged in to create a new resource
		$this->beforeFilter('auth.access:project', array('only' => 'create', 'store'));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		$resources = Resource::with(array('projects' => function($query) {
			$query->orderBy('updated_at','desc');
		}))->take(10)->get();
		return View::make('resource/index', compact('resources'));
	}

	/**
	 * @todo: add $id parameter for Project to create resource on
	 * Show the form for creating a new resource.
	 */
	public function create() {
		return View::make('resource/create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @method POST
	 * @precondition user is logged in
	 */
	public function store() {
		return $this->attemptEdit(new Resource(), true);
	}

	/**
	 * Display the specified resource.
	 * @param int $id resource id
	 */
	public function show($id)
	{
		$resource = Resource::findOrFail($id);
		return View::make('resource/show', compact('resource'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit($id)
	{
		$resource = Resource::findOrFail($id);
		return View::make('resource/edit', compact('resource'));
	}

	/**
	 * Update the specified resource in storage.
	 * @method PUT
	 */
	public function update($id)
	{
		$resource = Resource::findOrFail($id);
		return $this->attemptEdit($resource, false);
	}

	/**
	 * Show the delete confirmation page.
	 * @param int $id resource id
	 */
	public function confirm($id)
	{
		$resource = Resource::findOrFail($id);
		return View::make('resource/delete', compact('resource'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @method DELETE
	 */
	public function destroy($id)
	{
		$id = Input::get('resource');
		$resource = Resource::findOrFail($id);
		$resource->delete();

		return Redirect::action('ResourceController@index')
			->with('status', "Resource {$resource->title} successfully deleted!");
	}

	/**
	 * @todo: sanitize input
	 * Attemps to commit the edits on the resource in Input, or returns to fail action
	 * @param  Resource $resource   The project resource to modify
	 * @param  boolean $create     If we're creating, false for editing
	 */
	protected function attemptEdit(Resource $resource, $create = false)
	{
		$rules = ['name' => 'required', 'body' => 'required'];
		if ($create) {
			$rules['project'] = 'required';
		}

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$redirect = ($create) ? Redirect::to(URL::action('ResourceController@create') . '?project=' . Input::get('project')) :
				Redirect::action('ResourceController@edit', $resource->id);

			return $redirect->withInput(Input::all())->withErrors($validator);
		}

		$resource->name = e(Input::get('name'));
		$resource->url = e(Input::get('url'));
		$resource->body = e(Input::get('body'));
		$resource->type = null; //intentionally null
		$resource->votes = 0;

		if ($create) {
			DB::beginTransaction();
			$resource->user_id = Auth::user()->id;
		}

		$resource->save();

		//cycle through comma separated tag input and add the new tags and associate all the tags
		$tags = explode(",", Input::get('tags'));

		//is there a way to do this better? 
		foreach ($tags as $tagname) {
			$resource->tag($tagname);
		}

		$project_id = Input::get('project');

		if ($create) {
			// make sure that the relation gets inserted too
			try {
				$resource->projects()->attach($project_id);
				$resource->save();
				DB::commit();
			} catch (QueryException $e) {
				DB::rollback();

				Log::error('Error inserting project_resource relation with query "' . $e->getSql() . '" with parameters ' . print_r($e->getBindings(), true));
				return Redirect::to(URL::action('ResourceController@create') . '?project=' . Input::get('project'))
					->with('error', 'Error! Could not create the resource.');
			}
		}

		//@todo: fix session variables bug - no message is being displayed
		return Redirect::action('ProjectController@show', $project_id)
			->with('status', 'Resource created successfully!');
	}
}
