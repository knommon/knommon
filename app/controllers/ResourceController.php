<?php

/**
 * @todo: add user permissions for Resources
 */
class ResourceController extends Controller {

	public function __construct() {
		// for the user to be logged in to perform any action except view
		$this->beforeFilter('auth', array('except' => array('index', 'show')));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		$resources = Resource::orderBy('updated_at','desc')->take(10)->get();
		return View::make('resource/index', compact('resources'));
	}

	/**
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
		$validator = Validator::make(Input::all(), ['name' => 'required', 'body' => 'required', 'projectid' => 'required']);

		if ($validator->fails()) {
			$redirect = ($create) ? Redirect::action('ResourceController@create') : Redirect::action('ResourceController@edit', $resource->id);
			return $redirect->withInput(Input::all())->withErrors($validator);
		}

		$resource->name = Input::get('name');
		$resource->url = Input::get('url');
		$resource->body = e(Input::get('body'));
		$resource->type = 'Other';
		$resource->votes = 0;

		if ($create) {
			$resource->user_id = Auth::user()->id;
		}

		$resource->save();
		
		$resource->projects()->attach(Input::get('projectid'));
		$resource->save();

		return Redirect::action('ResourceController@show', $resource->id)
			->with('status', "Resource " . ($create ? 'created' : 'updated') . " successfully!");
	}
}
