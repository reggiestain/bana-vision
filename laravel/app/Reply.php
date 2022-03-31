<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Reply extends Model
{
   public function comment()
    {
    	return $this->belongsTo('App\Comment');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
