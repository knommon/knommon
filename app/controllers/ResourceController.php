<?php

use Illuminate\Support\MessageBag;

/* Controller for resources.
*  Displays resource pages and index page by returning Views
*  Handles resource creation, editing, and deletion too!
*/

class ResourceController extends BaseController {
public function index(){
	$resources=Resource::all();
	return View::make('resource/index', compact('resources'));
}

public function display(Resource $resource){
	return View::make('resource/home', compact('resource'));
}

public function add(){
	return View::make('resource/create');
}

public function edit(Resource $resource){
	return View::make('resource/edit', compact('resource'));
}

public function delete(Resource $resource){
	return View::make('resource/delete', compact('resource'));
}

public function handleAdd(){
	$resource = new Resource;
	$resource->name = Input::get('name');
	$resource->url = Input::get('url');
	$resource->about = Input::get('about');
	$resource->type = 'DEFAULT'; //haven't figured out resource types yet -- maybe just tags? We'll talk
	$resource->save();

	return Redirect::action('ResourceController@display', $resource->id);
}

public function handleEdit(){
	$resource = Resource::findOrFail(Input::get('id'));
	$resource->name = Input::get('name');
	$resource->url = Input::get('url');
	$resource->about = Input::get('about');
	//type?????
	$resource->save();

	return Redirect::action('ResourceController@display', $resource->id);
}

public function handleDelete(){
	$id = Input::get('resource');
	$resource = Resource::findOrFail($id);
	$resource->delete();

	return Redirect::action('ResourceController@index');
}

}