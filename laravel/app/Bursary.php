<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Bursary extends Model
{
    public $fillable = [
        'title',
        'closing_date',
        'application_link',
        'sector',
        'positions_available',
        'description'
    ];
    public $relationships = array('requirements');
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

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function requirements()
    {
        return $this->embedsMany('App\BursaryRequirement');
    }

    public function shares()
    {
        return $this->morphMany('App\Share','shareable');
    }
}
