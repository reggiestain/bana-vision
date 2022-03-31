<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Facility extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at',
        'school_id',
    ];
    public $fillable = [
        'name',
        'description',
        'type',
    ];

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

    public function school()
    {
    	return $this->belongsTo('App\School');
    }
}
