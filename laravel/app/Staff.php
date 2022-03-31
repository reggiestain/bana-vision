<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Staff extends Model
{
    public $fillable = [
        'position',
        'awards',
        'about',
        'user_id'
    ];

    public function user()
    {
        return $this->morphMany('App\User', 'usable');
    }

    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function teacherProficiency()
    {
    	return $this->hasMany('App\TeacherPoficiency');
    	
    }

    public function teacher()
    {
        return $this->embedsMany('App\Teacher');
    }

    public function requestedBook()
    {
        return $this->morphMany('App\RequestedBook', 'requestable');
    }

    public function checkOutBook()
    {
        return $this->morphMany('App\CheckedOutBook', 'checkedable');
    }

    public function attendance()
    {
        return $this->morphMany('App\Attendance', 'attendable');
    }

    public function images()
    {
        return $this->embedsMany('App\Image');
    }
}
