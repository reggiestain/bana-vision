<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class NeedsGratitude extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function images()
    {
        return $this->embedsMany('App\Image');
    }
}
