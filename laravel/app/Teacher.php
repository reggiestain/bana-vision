<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Teacher extends Model
{
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function staff()
    {
    	return $this->belongsTo('App\Staff');
    }

    public function teacherProficiency()
    {
    	return $this->embedsMany('App\TeacherProficiency');
    }
}
