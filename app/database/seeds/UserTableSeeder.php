<?php

//add dummy users to the site - how to do this for social??
class UserTableSeeder extends Seeder{
	
public function run() {
	$user = new User;
	$user->fname = "Rob";
	$user->lname = "Cobb";
	$user->email = "rwcobbjr@gmail.com";
	$user->password = Hash::make("password");
	$user->save();
			
			$skills = new Skill;
			$skills->user()->associate($user);
			$skills->save();

			$interests = new Interest;
			$interests->user()->associate($user);
			$interests->save();

	$user->save();


	$user = new User();
	$user->fname = "Nick";
	$user->lname = "Aversano";
	$user->email = "nick23hi@gmail.com";
	$user->password = Hash::make("password");
	$user->save();
			
			$skills = new Skill;
			$skills->user()->associate($user);
			$skills->save();

			$interests = new Interest;
			$interests->user()->associate($user);
			$interests->save();

	$user->save();
	}
}