<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Attendance extends Model
{

	protected $fillable = ['school_id','attendable_id','attendable_type' ,'week','mon','tue','wed','thur','fri'];
    public function attendable()
    {
        return $this->morphTo();
    }

    public function subjectAttended()
    {
    	return $this->hasMany('App\SubjectAttended');
    }
}
