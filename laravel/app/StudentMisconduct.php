<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class StudentMisconduct extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function schoolStudent()
    {
    	return $this->belongsTo('SchoolStudent');
    }
}
