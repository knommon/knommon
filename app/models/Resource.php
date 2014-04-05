<?php

class Resource extends Eloquent
{

	use Conner\Tagging\Taggable;
    
    // Album __belongs_to__ Artist
    public function projects()
    {
        return $this->belongsToMany('Project', 'project_resource','resource_id','project_id');
    }

}