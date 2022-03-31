<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Message extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function attachment()
    {
    	return $this->hasOne('App\Attachment');
    }
}
