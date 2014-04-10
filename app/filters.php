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

//@todo: leverage browser caching
App::before(function($request)
{
	//Response::header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
	//Response::header('Pragma', 'no-cache');
	//Response::header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
});


App::after(function($request, $response)
{
	// HTML Minification
	// @todo: fix this from causing errors in HTML display and JS on projects/create page
	if (App::Environment() != 'local') {
		if ($response instanceof Illuminate\Http\Response) { 
			$output = $response->getOriginalContent();
			// Clean comments
			//$output = preg_replace('/<!--([^\[|(<!)].*)/', '', $output);
			//$output = preg_replace('/(?<!\S)\/\/\s*[^\r\n]*/', '', $output);
			// Clean Whitespace
			//$output = preg_replace('/\s{2,}/', '', $output);
			//$output = preg_replace('/(\r?\n)/', '', $output);
			$response->setContent($output);
		}
	}
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

Route::filter('auth.access', function($route, $request, $mode = 'project')
{
	if (Auth::guest()) return Redirect::guest('user/login');

	$user = Auth::user();
	$error = null;
	$action = explode('.', Route::currentRouteName());
	$action = array_pop($action);
	if (!$action) $action = 'edit';
	//die(Route::getCurrentRoute()->getPath());
	//$param = Request::segment(1);
	switch ($mode) {
		case 'project':
			//try to find a project id from eithe the URL or the input project_id field
			$project = Route::input('projects');
			$project = (empty($project) ? Input::get('project_id') : $project);
			$project = (empty($project) ? Input::get('project') : $project);

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
				->where('user_id', '=', $user->id)
				->join('members', function($join) use ($user) {
					$join->on('project_resource.project_id', '=', 'members.project_id');
				})->get();

			if (empty($result))
				$error = "You don't have access to this resource.";

			break;
	}

	if ($error != null) {
		$errors = new \Illuminate\Support\MessageBag();
		$errors->add('error', $error);

		try {
			return Redirect::back()->withErrors($errors);
		} catch (InvalidArgumentException $e) {
			return Redirect::to('/');
		}
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

/**
 * Cache Filters
 * http://markvaneijk.com/caching-routes-using-filters-in-laravel-4
 * 
 * ex. Route::get('/', array('before' => 'cache', 'after' => 'cache', 'uses' => 'HomeController@show'));
 * @todo: leverage caching on more than just static pages, and use Cache::forget($key) when a specific 
 * page is modified
 * @todo: implement caching backend Memcahced, Redis, etc.
 * @todo: use a user-dependent caching method
 */
Route::filter('cache', function($route, $request, $response = null)
{
	$key = 'route-'.Str::slug(Request::url());

	if (is_null($response) && Cache::has($key)) {
		return Cache::get($key);
	}
	elseif (!is_null($response) && !Cache::has($key)) {
		Cache::put($key, $response->getContent(), $minutes = 30);
	}
});