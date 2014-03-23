<?php

class ProjectController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(){
		$projects=Project::all();
		
		return View::make('project/index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('project/create');	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$project = new Project;
		$project->title = Input::get('title');
		$project->about = Input::get('about');
		$project->save();
		
		return Redirect::action('ProjectController@getProject', $project->id);	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getProject($id)
	{
		$project = Project::findOrFail($id);
		return View::make('project/show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$project = Project::findOrFail($id);
		return View::make('project/edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function postEdit()
	{
		$project = Project::findOrFail(Input::get('id'));
		$project->title = Input::get('title');
		$project->about = Input::get('about');
		$project->save();

		return Redirect::action('ProjectController@getProject', $project->id);
	}

	
	public function getDelete($id)
	{
		$project = Project::findOrFail($id);
		return View::make('project/delete', compact('project'));
	}

/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDelete($id){
		$project=Project::findOrFail($id);
		$project->delete();

		return Redirect::action('ProjectController@getIndex');
	}

}