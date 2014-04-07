<?php

class SearchController extends Controller {

	public function search() {
		//once we actually have search implemented, this is the control spot

	}	


	public function tag($slug) {
		$projects = Project::withTag($slug)->get();
		$resources = Resource::withTag($slug)->get();
		$skills = DB::table('users')->join('skills', 'users.id', '=', 'skills.user_id')
			->join('tagging_tagged', 'taggable_id', '=', 'skills.id')
			->where('tagging_tagged.tag_slug', '=', 'hello')->get();
		
		/*$interests = DB::table('users')->join('interests', 'users.id', '=', 'interests.user_id')
			->join('tagging_tagged', 'taggable_id', '=', 'interests.id')
			->where('tagging_tagged.tag_slug', '=', 'hello')->get();
		*/
		
		//Prettify the tag for display
		$tag = Str::unslug($slug);

		return View::make('search/tag', array('projects' => $projects, 'resources' => $resources, 'skills' => $skills,
			/*'interests' => $interests,*/ 'tag' => $tag));
	}

}
