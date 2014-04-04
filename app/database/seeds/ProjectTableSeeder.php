<?php

//add dummy projects to the site
class ProjectTableSeeder extends Seeder{
	

	public function run(){
	//add terpthon project and join user 1 to it
	$project = new Project();
	$project->title = "Terp Thon 2014";
	$project->tagline = "Raising money FTK #terpthon";
	$project->about = "24-hour dance party to raise money FTK (for the kids) at Children's National";
	
	$user = User::find(1);
	$project->user_id = $user->id;
	$project->save();

	$user->join($project->id);

	//create capstone engineering design project and join user 2
	$project = new Project();
	$project->title = "Tune-Pro: Senior Capstone Design Project";
	$project->tagline = "An automatic guitar tuner";
	$project->about = "For our senior design project for ENES488D at the University of Maryland, we are 
		designing and prototyping a clip-on automatic guitar tuner. ";
	
	$user = User::find(2);
	$project->user_id = $user->id;
	$project->save();
	
	$user->join($project->id);


	//create building the knommon website project and join users 1 and 2
	$project = new Project();
	$project->title = "Building a Website: Knommon.com";
	$project->tagline = "Making this very site!";
	$project->about = "Using the Laravel framework and Bootstrap (plus some other cool tools - check our resources)
	to make a kick-butt site. We want people to be able to create, share, and find projects so they can learn. We're 
	learning ourselves, by building this website!";
	
	$user = User::find(1);
	$project->user_id = $user->id;
	$project->save();
	
	$user->join($project->id);
	$user = User::find(2);
	$user->join($project->id);
	}
}