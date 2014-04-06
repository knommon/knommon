<?php

class Skill extends Eloquent
{
	use Conner\Tagging\Taggable;

	public function user(){
		return $this->belongsTo('User');
	}

	public $timestamps = false;
	
}