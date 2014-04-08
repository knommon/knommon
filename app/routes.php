<?php

// General pages
Route::get('/', function() { return View::make('hello'); });
Route::get('/about', function() { return View::make('about'); });
Route::get('/contact', function() {return View::make('contact'); });

// Patterns
Route::pattern('id', '\d+');
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

// User routes
Route::controller('user', 'UserController');
Route::controller('password', 'RemindersController');
Route::controller('social', 'SocialController', array(
	'getFacebook' => 'facebook', 'getTwitter' => 'twitter', 'getGoogle' => 'google',
));
Route::get('register/twitter', array('as' => 'register.twitter', 'uses' => 'SocialController@registerTwitter'));

// Project & Resource routes
Route::resource('projects', 'ProjectController');
Route::resource('resources', 'ResourceController');
Route::get('projects/confirm/{id}', 'ProjectController@confirm');
Route::get('resources/confirm/{id}', 'ResourceController@confirm');

Route::get('projects/{id}/{slug?}', array('as' => 'project.show', 'uses' => 'ProjectController@show'));

// Search Controller
Route::get('tags/{slug}', array('as' => 'tag.show', 'uses' => 'SearchController@tag'));
Route::get('search/{slug}', 'SearchController@search');
