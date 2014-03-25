<?php

//default to a list of projects for now - homepage to come
Route::get('/', 'ProjectController@index');

// User routes
Route::controller('user', 'UserController');
Route::controller('password', 'RemindersController');
Route::controller('social', 'SocialController', array(
	'getFacebook' => 'facebook', 'getTwitter' => 'twitter', 'getGoogle' => 'google',
));

// Project & Resource routes
Route::resource('projects', 'ProjectController');
Route::resource('resources', 'ResourceController');
Route::get('projects/confirm/{id}', 'ProjectController@confirm');
Route::get('resources/confirm/{id}', 'ResourceController@confirm');
