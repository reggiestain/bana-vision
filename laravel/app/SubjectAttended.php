<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class SubjectAttended extends Model
{

	protected $fillable = ['attendance_id','day','time','curriculumn_id'];
    public function attendences()
    {
    	return $this->belongsTo('App\Attendance');
    }
}
