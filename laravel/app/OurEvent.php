<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class OurEvent extends Model
{
    //public $table = "ourevents";
    //public $timestamps = false;
    ////protected $hidden = ['comments'];
    public $fillable = [
        'name',
        'description',
        'venue',
        'date',
        'timeslot'
    ];

    
    public $relationships = array('images','comments');
    public function images()
    {
        return $this->embedsMany('App\Image');
    }

     public function comments()
    {
        return $this->embedsMany('App\Comment');
    }
    
     public function likes()
    {
        return $this->embedsMany('App\Like', 'likeable');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /*public function likes()
    {
    	return $this->hasMany('App\Like');
    }*/
    public function shares()
    {
        return $this->embedsMany('App\Share','shareable');
    }
    
}
