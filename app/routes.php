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
Route::get('/', 'ProjectController@index');


Route::controller('user', 'UserController');
Route::controller('password', 'RemindersController');
Route::controller('social', 'SocialController', array(
	'getFacebook' => 'facebook',
	'getGoogle' => 'google',
	'getAuth' => 'auth'
));


//project routes - send it to the controller to show pages
Route::get('/projects', 'ProjectController@index');
Route::get('/projects/create', 'ProjectController@create');
Route::get('/projects/{project}', 'ProjectController@display');
Route::get('/projects/edit/{project}', 'ProjectController@edit');
Route::get('/projects/delete/{project}', 'ProjectController@delete');

//project post routes - send to controller too!
Route::post('/projects/create', 'ProjectController@handleCreate');
Route::post('/projects/edit', 'ProjectController@handleEdit');
Route::post('/projects/delete', 'ProjectController@handleDelete');

//resource get and post routes - similar to project
Route::get('/resources', 'ResourceController@index');
Route::get('/resources/add', 'ResourceController@add');
Route::get('/resources/{resource}', 'ResourceController@display');
Route::get('/resources/edit/{resource}', 'ResourceController@edit');
Route::get('/resources/delete/{resource}', 'ResourceController@delete');

Route::post('/resources/add', 'ResourceController@handleAdd');
Route::post('/resources/edit', 'ResourceController@handleEdit');
Route::post('/resources/delete', 'ResourceController@handleDelete');

