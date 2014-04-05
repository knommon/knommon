<?php

class Location extends Eloquent {

	protected $table = 'locations';
	public $timestamps = false;

	public static $columns = array('id', 'street_number', 'establishment', 'route', 'locality', 
		'administrative_area_level_3', 'administrative_area_level_2', 'administrative_area_level_1',
		'state', 'country', 'postal_code');

	public function projects()
	{
		return $this->hasMany('Project');
	}

	//$pos - array x,y values
	//@todo: use PostGIS - http://forumsarchive.laravel.io/viewtopic.php?id=5133
	public function setPositionAttribute($pos)
	{
		$this->attributes['position'] =  DB::raw("point({$pos[0]},{$pos[1]})");
	}
}
