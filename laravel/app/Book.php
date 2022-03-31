<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function loanedBook()
    {
    	return $this->hasMany('App\LoanedBook');
    }

    public function libraryBook()
    {
    	return $this->hasMany('App\LibraryBook');
    }

    public function storageBook()
    {
    	return $this->hasMany('App\StorageBook');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function shares()
    {
        return $this->morphMany('App\Share','shareable');
    }

}
