<?php

class Task extends Eloquent
{
    // Album __belongs_to__ Artist
    public function project()
    {
        return $this->belongsTo('Project');
    }

}