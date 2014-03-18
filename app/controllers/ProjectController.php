<?php

use Illuminate\Support\MessageBag;

class ProjectController extends Controller {

public function anyEdit()
	{
		$errors = new MessageBag();

		if ($old = Input::old('errors')) {
			$errors = $old;
		}

		$data = ['errors' => $errors];

		if (Input::server('REQUEST_METHOD') == 'POST') {
			$validator = Validator::make(Input::all(), [
				'title' => 'required',
				'description' => 'required'
			]);

			$edits = [
				'title' => Input::get('title'),
				'description' => Input::get('description')
			];

			if ($validator->passes() && Auth::attempt($login)) {
				echo 'SUCCESS!';
			} else {
				$data['errors'] = new MessageBag(['password' => 'Invalid username or password.']);
			}

			$data['title'] = Input::get('title');

			return Redirect::route('user/login')->withInput($data);
		}

		return View::make('project/edit', $data);
	}
	public function anyLogin()
	{
		$errors = new MessageBag();

		if ($old = Input::old('errors')) {
			$errors = $old;
		}

		$data = ['errors' => $errors];

		if (Input::server('REQUEST_METHOD') == 'POST') {
			$validator = Validator::make(Input::all(), [
				'email' => 'required',
				'password' => 'required'
			]);

			$login = [
				'email' => Input::get('email'),
				'password' => Input::get('password')
			];

			if ($validator->passes() && Auth::attempt($login)) {
				echo 'SUCCESS!';
			} else {
				$data['errors'] = new MessageBag(['password' => 'Invalid username or password.']);
			}

			$data['email'] = Input::get('email');

			return Redirect::route('user/login')->withInput($data);
		}

		return View::make('user/login', $data);
	}

	public function anySignup() {
		$errors = new MessageBag();

		if ($old = Input::old('errors')) {
			$errors = $old;
		}

		$data = ['errors' => $errors];

		if (Input::server('REQUEST_METHOD') == 'POST') {
			$validator = Validator::make(Input::all(), [
				'email' => 'required|email',
				'password' => 'required|min:6'
			]);

			if ($validator->passes()) {

			} else {

			}
		}

		return View::make('user/signup', $data);
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::to('/');
	}

	public function anyRequest() {

	}

	public function anyReset() {
		
	}
}