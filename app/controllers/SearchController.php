<?php

class SearchController extends Controller {

	public function search(){
		//once we actually have search implemented, this is the control spot

	}	


	public function tag($slug){
		$projects = Project::withTag($slug)->get();
		$resources = Resource::withtag($slug)->get();
		return View::make('search/tag', array('projects' => $projects, 'resources' => $resources, 'tag' => $slug));
	}

}
