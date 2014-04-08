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

	/**
	 * $pos - array x,y values
	 * @todo: use PostGIS - http://forumsarchive.laravel.io/viewtopic.php?id=5133
	 */
	public function setPositionAttribute($pos)
	{
		$this->attributes['position'] =  DB::raw("point({$pos[0]},{$pos[1]})");
	}

	/**
	 * Where the location is within the square bounds defined by threshold
	 * @param $pos - array x,y values
	 * @param $threshold what is near defined as in terms of latitude and longitude
	 */
	public function scopeNear($query, $pos, $threshold = 0.00001) {
		return $query->whereRaw("@(abs(position[0]) - abs({$pos[0]})) < {$threshold} AND @(abs(position[1]) - abs({$pos[1]})) < {$threshold}");
	}
}
