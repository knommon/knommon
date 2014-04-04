<?php

Route::get('/', function() {
	return View::make('hello');
});
Route::get('/about', function() {
	return View::make('about');
});

// User routes
Route::controller('user', 'UserController');
Route::controller('password', 'RemindersController');
Route::controller('auth', 'SocialController', array(
	'getFacebook' => 'facebook', 'getTwitter' => 'twitter', 'getGoogle' => 'google',
));

// Project & Resource routes
Route::resource('projects', 'ProjectController');
Route::resource('resources', 'ResourceController');
Route::get('projects/confirm/{id}', 'ProjectController@confirm');
Route::get('resources/confirm/{id}', 'ResourceController@confirm');
Route::post('resources/create', 'ResourceController@create');