<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class NoteExplanation extends Model
{
    public function note()
    {
    	return $this->belongsTo('App\Note');
    }

    /*public function rating()
    {
    	return $this->hasMany('App\Rating');
    }*/
}
