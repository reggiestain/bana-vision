<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FeaturedStudent extends Model
{
    protected $hidden = [
        'updated_at',
        'school_student',
        'school_id',
        'school_student_id'
    ];
    public $relationships = array(
        'schoolStudent',
        'schoolStudent~images',
        'schoolStudent~school~user'
    );
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function schoolStudent()
    {
        return $this->belongsTo('App\SchoolStudent');
    }

     public function comments()
    {
        return $this->morphMany(
            'App\Comment', 
            'commentable'
        );
    }
    
     public function likes()
    {
        return $this->morphMany(
            'App\Like', 
            'likeable'
        );
    }

    public function shares()
    {
        return $this->morphMany(
            'App\Share',
            'shareable'
        );
    }

    public function images()
    {
        return $this->embedsMany('App\Image');
    }
}
