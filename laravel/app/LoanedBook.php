<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class LoanedBook extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function books()
    {
    	return $this->belongsTo('App\Book','book_id');
    }

    public function schoolStudent()
    {
    	return $this->belongsto('App\SchoolStudent');
    }
}
