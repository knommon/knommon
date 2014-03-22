<?php


class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	public function tasks()
	{
		return $this->hasMany('Task');
	}

	public function resources()
	{
		return $this->belongsToMany('Resource', 'project_resource', 'project_id', 'resource_id');
	}

}