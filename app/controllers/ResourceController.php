<?php

class ResourceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$resources=Resource::all();
		return View::make('resource/index', compact('resources'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('resource/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$resource = new Resource;
		$resource->name = Input::get('name');
		$resource->url = Input::get('url');
		$resource->about = Input::get('about');
		$resource->type = 'DEFAULT'; //haven't figured out resource types yet -- maybe just tags? We'll talk
		$resource->save();

	return Redirect::action('ResourceController@getResource', $resource->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getResource($id)
	{
		$resource = Resource::findOrFail($id);
		return View::make('resource/show', compact('resource'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$resource = Resource::findOrFail($id);
		return View::make('resource/edit', compact('resource'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function postEdit()
	{
		$resource = Resource::findOrFail(Input::get('id'));
		$resource->name = Input::get('name');
		$resource->url = Input::get('url');
		$resource->about = Input::get('about');
		//type?????
		$resource->save();

		return Redirect::action('ResourceController@getResource', $resource->id);
	}

	public function getDelete($id){
		$resource = Resource::findOrFail($id);
		return View::make('resource/delete', compact('resource'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDelete()
	{
		$id = Input::get('resource');
		$resource = Resource::findOrFail($id);
		$resource->delete();

		return Redirect::action('ResourceController@getIndex');
	}

}