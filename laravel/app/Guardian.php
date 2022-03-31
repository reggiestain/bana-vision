<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Guardian extends Model
{
    public function schoolStudent()
    {
    	return $this->belongsTo('App\SchoolStudent');
    }

    public function school()
    {
    	return $this->belongsto('App\School');
    }
}
