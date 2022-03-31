<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class LibraryBook extends Model
{
    public $relationships = array('book','book~images','book~school~user');
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function book()
    {
    	return $this->belongsTo('App\Book');
    }

    public function requestedBook()
    {
    	return $this->hasMany('App\RequestedBook');
    }

    public function checkedOutBook()
    {
    	return $this->hasMany('App\CheckedOutBook');
    }

    public function shares()
    {
        return $this->morphMany('App\Share','shareable');
    }
}
