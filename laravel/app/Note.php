<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Note extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function noteExplanation()
    {
    	return $this->hasMany('App\NoteExplanation');
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
