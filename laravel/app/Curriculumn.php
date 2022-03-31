<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Curriculumn extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function teacherProficiency()
    {
    	return $this->hasMany('App\TeacherProficiency');
    }
}
