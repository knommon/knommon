<?php

//default to a list of projects for now - homepage to come
Route::get('/', 'ProjectController@index');

// User routes
Route::controller('user', 'UserController');
Route::controller('password', 'RemindersController');
Route::controller('social', 'SocialController', array(
	'getFacebook' => 'facebook',
	'getGoogle' => 'google',
	'getAuth' => 'auth'
));

// Project & Resource routes
Route::controller('projects', 'ProjectController');
Route::controller('resources', 'ResourceController');

