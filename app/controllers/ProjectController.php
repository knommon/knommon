<?php

use Illuminate\Support\MessageBag;

/* Controller for projects. 
*  Displays project pages and index page by returning Views
*  Handles project creation, editing, and deletion too!
*/

class ProjectController extends BaseController {

public function index(){
	$projects=Project::all();
	return View::make('project/index', compact('projects'));
}

public function display(Project $project){
	return View::make('project/home', compact('project'));
}

public function create(){
	return View::make('project/create');
}

public function handleCreate(){
	$project = new Project;
	$project->title = Input::get('title');
	$project->about = Input::get('about');
	$project->save();
	return Redirect::action('ProjectController@display', $project->id);
}

public function edit(Project $project){
	return View::make('project/edit', compact('project'));
}

public function handleEdit(){
	$project = Project::findOrFail(Input::get('id'));
	$project->title = Input::get('title');
	$project->about = Input::get('about');
	$project->save();

	return Redirect::action('ProjectController@display', $project->id);
}

public function delete(Project $project){
	return View::make('project/delete', compact('project'));
}

public function handleDelete(){
	$id = Input::get('project');
	$project=Project::findOrFail($id);
	$project->delete();

	return Redirect::action('ProjectController@index');
}

}