<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
when {project} or {resource} is in the get or post url, search the database
for the corresponding project and pass it as a parameter to the controller
*/
Route::model('project','Project');
Route::model('resource','Resource');

//default to a list of projects for now - search to come
Route::get('/', 'ProjectController@getIndex');

Route::controller('user', 'UserController');
Route::controller('password', 'RemindersController');
Route::controller('social', 'SocialController', array(
	'getFacebook' => 'facebook',
	'getGoogle' => 'google',
	'getAuth' => 'auth'
));

Route::controller('projects', 'ProjectController');
Route::controller('resources', 'ResourceController');
