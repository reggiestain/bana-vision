<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class News extends Model
{
     public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
