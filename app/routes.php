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

Route::get('/', function() {
	return View::make('hello');
});

Route::controller('user', 'UserController');
Route::controller('password', 'RemindersController');
Route::controller('social', 'SocialController', array(
	'getFacebook' => 'facebook',
	'getGoogle' => 'google',
	'getAuth' => 'auth'
));

Route::get('project', function(){
	return View::make('project/home');
});
Route::any('project/edit', 'ProjectController@anyEdit');