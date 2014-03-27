<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('user/login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

//@todo: there may be a redirect loop here when project_id is not defined
Route::filter('auth.access', function($route, $request, $mode = 'project') {
	if (Auth::guest()) return Redirect::guest('user/login');

	$user = Auth::user();
	$error = null;
	$action = explode('.', Route::currentRouteName());
	$action = array_pop($action);
	if (!$action) $action = 'edit';
	//die(Route::getCurrentRoute()->getPath());
	switch ($mode) {
		case 'project':
			//try to find a project id from eithe the URL or the input project_id field
			$project = Route::input('projects');
			$project = (empty($project) ? Input::get('project_id') : $project);
			if (empty($project)) {
				$error = "Could not find the specified project.";
			} else if (!$user->isMember($project))
				$error = "You must be a member of this project to {$action} it.";
			break;
		case 'resource':
			$id = Route::input('id');
			$id = (isset($id) ? $id : Route::input('resources'));
			$id = (empty($id) ? Input::get('resource') : $id);

			//SELECT r.resource_id, p.user_id FROM project_resource AS r JOIN members as p 
			//ON r.project_id = p.project_id WHERE user_id = ? AND resource_id = ?;
			$result = DB::table('project_resource')
				->select(['project_resource.resource_id', 'members.user_id'])
				->where('resource_id', '=', $id)
				->join('members', function($join) use ($user) {
					$join->on('project_resource.project_id', '=', 'members.project_id')
						->where('user_id', '=', $user->id);
				})->get();

			if (empty($result))
				$error = "You don't have access to {$action} this resource.";
			break;
	}

	if ($error != null) {
		$errors = new \Illuminate\Support\MessageBag();
		$errors->add('error', $error);
		return Redirect::back()->withErrors($errors);
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
