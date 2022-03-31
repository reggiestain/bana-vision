<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Announcement extends Model
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
