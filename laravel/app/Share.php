<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Share extends Model
{
    public function shareable()
    {
        return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
