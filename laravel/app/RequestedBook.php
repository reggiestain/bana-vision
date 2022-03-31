<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class RequestedBook extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function libraryBook()
    {
    	return $this->belongsTo('App\LibraryBook');
    }

    public function requestable()
    {
        return $this->morphTo();
    }

    public function checkedOutBook()
    {
    	return $this->hasMany('App\CheckedOutBook');
    }
}
