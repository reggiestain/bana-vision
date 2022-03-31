<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class CheckedOutBook extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function libraryBook()
    {
    	return $this->belongsTo('App\LibraryBook');
    }

    public function requestedBook()
    {
    	return $this->belongsTo('App\RequestedBook');
    }

    public function checkedable()
    {
        return $this->morphTo();
    }
}
