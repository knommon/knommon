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

Route::get('users', function(){
	return 'Users!';
});

//Route::any('user/login', 'UserController@loginAction');
Route::controller('user', 'UserController');

Route::group(array('before' => 'auth'), function() {
    Route::get('user/profile', function() {
		// Has Auth Filter
	});
});

Route::get('project', function(){
	return View::make('project/home');
});

Route::any('project/edit', 'ProjectController@anyEdit');