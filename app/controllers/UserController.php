<?php

use Illuminate\Support\MessageBag;

define('WELCOME_MESSAGE', 'Thanks for registering!');
define('ERROR_MESSAGE', 'The following errors occurred:');

class UserController extends Controller {

	const HOME_ROUTE = '/';

	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth', array('only' => array('getDashboard', 'getWelcome')));
	}

	public function getLogin() {
		// if we're already logged in
		if (Auth::check()) {
			return Redirect::to('/');
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
			//@todo: fix this... ideally put ?continue=URL in the url
			return Redirect::intended('/');
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

			$id = $user->id;

			// Laravel SQL Builder
			// $id = DB::table('users')->insertGetId( array('email' => Input::get('email')) );

			// raw SQL
			/*$sql = "INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)"; //RETURNING id for postgres
			$success = DB::insert($sql, array(Input::get('fname'), Input::get('lname'), Input::get('email'), Hash::make(Input::get('password')));
			$id = DB::getPdo()->lastInsertId();
			*/

			Auth::loginUsingId($id);

			return Redirect::to('user/welcome')
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
}