<?php

//add dummy resources to the site
class ResourceTableSeeder extends Seeder{
	
public function run(){
	//add resource to the first project
	$resource = new Resource();
	$resource->name = "Children's Miracle Network";
	$resource->url = "http://childrensmiraclenetworkhospitals.org/";
	$resource->body = "This is where we are sending the money we raise!";
	$resource->type = "other"; //intentionally null
	$resource->votes = 0;
	$resource->user_id = 1;

	$resource->save();

	$project_id = 1;

	$resource->projects()->attach($project_id);
	$resource->save();

	//add resource to the second project
	$resource = new Resource();
	$resource->name = "Radio Shack Arduino radio tuner";
	$resource->url = "https://www.radioshackdiy.com/arduino-guitar-tuner";
	$resource->body = "Similar-looking how-to";
	$resource->type = "Book"; //intentionally null
	$resource->votes = 0;
	$resource->user_id = 2;

	$resource->save();

	$project_id = 2;

	$resource->projects()->attach($project_id);
	$resource->save();

	$resource = new Resource();
	$resource->name = "Laravel PHP framework";
	$resource->url = "http://laravel.com/docs";
	$resource->body = "'the web framework for artisans' that we are using for developing our site";
	$resource->type = "Text"; //intentionally null
	$resource->votes = 0;
	$resource->user_id = 1;

	$resource->save();

	$project_id = 3;

	$resource->projects()->attach($project_id);
	$resource->save();	

	$resource = new Resource();
	$resource->name = "Grunt js task runner";
	$resource->url = "http://gruntjs.com/";
	$resource->body = "Grunt helps with development by monitoring files for you and recompiling when you modify.";
	$resource->type = "Article"; //intentionally null
	$resource->votes = 0;
	$resource->user_id = 2;

	$resource->save();

	$project_id = 3;

	$resource->projects()->attach($project_id);
	$resource->save();		

}
}