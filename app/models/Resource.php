<?php

class Resource extends Eloquent
{
    // Album __belongs_to__ Artist
    public function project()
    {
        return $this->belongsToMany('Project', 'project_resource','resource_id','project_id');
    }

}