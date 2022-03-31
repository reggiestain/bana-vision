<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class Comment extends Model 
{
   // public $timestamps = false;
    public function commentable()
    {
        return $this->morphTo();
    }
    
      public function likeable()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
