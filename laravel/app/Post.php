<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{

    public $relationships = array('images');
    public $fillable = ['body'];
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function likes()
    {
    	return $this->morphMany('App\Like','likeable');
    }

    public function comments()
    {
    	return $this->morphMany('App\Comment','commentable');
    }
    
    public function images()
    {
        return $this->embedsMany('App\Image');
    }

    public function shares()
    {
        return $this->morphMany('App\Share','shareable');
    }

    public function videos()
    {
        return $this->morphMany('App\Video', 'videoable');
    }
}
