<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Attachment extends Model
{

	public function message()
	{
		return $this->belongsTo('App\Message');
	}
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function videos()
    {
        return $this->morphMany('App\Video', 'videoable');
    }
}
