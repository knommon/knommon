<?php

use Illuminate\Support\MessageBag;

define('WELCOME_MESSAGE', 'Thanks for registering!');
define('ERROR_MESSAGE', 'The following errors occurred:');
define('LOGIN_LANDING', '/projects');

/**
 * @todo: make the project join/leave follow/unfollow actions POST requests
 */
class UserController extends Controller {

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth', array('only' => array(
			'getDashboard', 'getWelcome', 'getJoin', 'getLeave', 'getFollow', 'getUnfollow'
		)));
	}

	public function index() {
		if (Auth::check()) {
			return Redirect::action('ProjectController@index');
		}

		return View::make('hello');
	}

	public function getLogin() {
		// if we're already logged in
		if (Auth::check()) {
			return Redirect::to(LOGIN_LANDING);
		}

		return View::make('user.login');
	}

	public function postLogin() {
		$validator = Validator::make(Input::all(), ['email' => 'required', 'password' => 'required']);

		$login = [
			'email' => Input::get('email'),
			'password' => Input::get('password')
		];

		$remember = (bool)(Input::get('remember'));

		if (($passes = $validator->passes()) && Auth::attempt($login, $remember)) {
			//@todo: ideally put ?continue=URL in the url
			return Redirect::intended(LOGIN_LANDING);
		}
		
		if ($passes) {
			$errors = new MessageBag();
			$errors->add('password', 'Invalid username or password.');
		} else {
			$errors = $validator->messages();
		}
		$data = array();
		$data['email'] = Input::get('email');
		$data['remember'] = Input::get('remember');

		return Redirect::back()->withInput($data)->withErrors($errors);
	}

	public function getRegister() {
		return View::make('user.register');
	}

	//@todo: refactor skills & interests on this & the SocialController
	//@todo: include email confirmations
	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {
			// Eloquent
			$user = new User;
			$user->fname = Input::get('fname');
			$user->lname = Input::get('lname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));

			$user->save();

			$skills = new Skill;
			$skills->user()->associate($user);
			$skills->save();

			$interests = new Interest;
			$interests->user()->associate($user);
			$interests->save();

			$id = $user->id;

			Auth::loginUsingId($id);

			return Redirect::to(LOGIN_LANDING)
				->with('message', WELCOME_MESSAGE);
		} else {
			return Redirect::to('user/register')
				->with('message', ERROR_MESSAGE)
				->withErrors($validator)
				->withInput();
		}
	}

	public function getLogout() {
		Auth::logout();
		$hybridAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
		$hybridAuth->logoutAllProviders();
		return Redirect::to('/');
	}

	public function getWelcome() {
		return View::make('user.welcome');
	}

	//@todo: should this be /user/{id}/profile instead of /user/profile/{id} ?
	public function getProfile($id) {
		$me = Auth::user();
		if ($me == null || $id != $me->id) {
			$user = User::findOrFail($id);
			$canEdit = false;
		} else {
			$user = $me;
			$canEdit = true;
		}
		$skills = $user->skills->tagged()->get();
		$interests = $user->interests->tagged()->get();
		$projects = $user->projects;
		
		return View::make('user.profile', array('user' => $user, 'canEdit' => $canEdit, 'skills' => $skills, 'projects' => $projects, 
			'interests' => $interests));
	}

	public function getEdit($id) {
		$user = Auth::user();
		if ($user == null || $user->id != $id) {
			return Redirect::back()->with('error', 'You must be signed in.');
		}

		$skills = $user->skills->tagNames();
		$interests = $user->interests->tagNames();

		return View::make('user.edit', array('user' => $user, 'skills' => $skills, 'interests' => $interests));
	}


	public function postProfile($id) {
		$user = Auth::user();
		if ($user == null || $user->id != $id) {
			return Redirect::back()->with('error', 'Invalid user');
		}

		$user->about = e(Input::get('about'));

		$skills = explode(",", Input::get('skills'));
		foreach ($skills as $skill) {
			$user->skills->tag($skill);
		}

		$interests = explode(",", Input::get('interests'));
		foreach ($interests as $interest) {
			$user->interests->tag($interest);
		}

		$user->save();
		return Redirect::action('UserController@getProfile', $id)->with('status', "User profile updated successfully!");
	}

	//@todo: make these all one post request, postProject/Subscribe with paramers for the method
	public function getJoin($id) {
		Project::findOrFail($id);
		if (Auth::user()->join($id)) {
			return Redirect::action('ProjectController@show', $id)->with('status', "You joined successfully!");
		}
		return Redirect::action('ProjectController@show', $id)->with('error', "You are already a member of this project!");
	}

	public function getLeave($id) {
		Project::findOrFail($id);
		if (Auth::user()->leave($id)) {
			return Redirect::action('ProjectController@show', $id)->with('status', "You have left the project!");
		}
		return Redirect::action('ProjectController@show', $id)->with('error', "You are not a member of this project!");
	}

	public function getFollow($id) {
		$project = Project::findOrFail($id);
		
		if (Auth::user()->follow($id)) {
			return Redirect::action('ProjectController@show', $id)->with('status', "You are now following {$project->title}.");
		}
		return Redirect::action('ProjectController@show', $id)->with('error', "You are already following this project.");
	}

	public function getUnfollow($id) {
		$project = Project::findOrFail($id);
		
		if (Auth::user()->unfollow($id)) {
			return Redirect::action('ProjectController@show', $id);
		}
		return Redirect::action('ProjectController@show', $id)->with('error', "You are not following this project.");
	}
}