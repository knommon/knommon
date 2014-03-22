<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 */
	public function getForgot() {
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 */
	public function postForgot() {
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 */
	public function getReset($token = null) {
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 */
	public function postReset() {
		$validator = Validator::make(Input::all(), [
			'email'                 => 'required|email',
			'password'              => User::$rules['password'],
			'password_confirmation' => 'required|same:password',
		]);
		
		if ($validator->fails()) return Redirect::back()->withErrors($validator);

		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password) {
			$user->password = Hash::make($password);
			$user->save();
			Auth::login($user);
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}

}