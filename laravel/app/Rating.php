<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Rating extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function school()
    {
    	return $this->belongsTo('App\School');
    }
}
