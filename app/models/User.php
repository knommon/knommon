<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public static $rules = array(
		'fname'=>'required|alpha|min:2',
		'lname'=>'required|alpha|min:2',
		'email'=>'required|email|unique:users',
		'password'=>'required|alpha_num|min:7|confirmed',
		'password_confirmation'=>'same:password'
	);

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Checks if this user is a member of the given project.
	 * @param  int  $project_id Project id
	 * @return bool if the user is a member of the project
	 */
	public function isMember($project_id, $table = 'members') {
		$result = DB::table($table)
			->where('user_id', '=', $this->id)
			->where('project_id', '=', $project_id)
			->get();

		return !empty($result);
	}

	/**
	 * Adds this user to the project.
	 * @param  int  $project_id Project id
	 * @return bool if the insert was successful
	 */
	public function join($project_id, $table = 'members') {
		try {
			$inserted = DB::table($table)->insert(array(
				'user_id' => $this->id,
				'project_id' => $project_id
			));
		} catch (Illuminate\Database\QueryException $e) {
			return false;
		}

		return $inserted;
	}

	public function leave($project_id, $table = 'members') {
		$count = DB::table($table)
			->where('user_id', '=', $this->id)
			->where('project_id', '=', $project_id)
			->delete();

		return ($count == 1);
	}

	public function isFollowing($project_id) {
		return $this->isMember($project_id, 'follows');
	}

	public function follow($project_id) {
		return $this->join($project_id, 'follows');
	}

	public function unfollow($project_id) {
		return $this->leave($project_id, 'follows');
	}

	public function projects()
	{
		return $this->belongsToMany('Project', 'members');
	}

	public function follows()
	{
		return $this->belongsToMany('Project', 'follows');
	}

	//dumb naming conventions and rob being dumb about things - leave it alone unless we are switching the tag machine
	public function skills()
	{
		return $this->hasOne('Skill');
	}

	public function interests()
	{
		return $this->hasOne('Interest');
	}

}