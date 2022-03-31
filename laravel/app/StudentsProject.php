<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class StudentsProject extends Model
{
    protected $hidden = ['school_id','updated_at'];
    public $fillable = ['name','description','category'];
    public function schoolStudents()
    {
        return $this->embedsMany('App\SchoolStudent', 'participants');
    }

    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function images()
    {
        return $this->embedsMany('App\Image');
    }

     public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
    
     public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function shares()
    {
        return $this->morphMany('App\Share','shareable');
    }
}
