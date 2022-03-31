<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class StorageBook extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function books()
    {
    	return $this->belongsTo('App\Book');
    }
}
