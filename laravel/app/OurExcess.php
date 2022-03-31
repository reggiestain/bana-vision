<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class OurExcess extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
    	return $this->hasMany('App\Comments');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
