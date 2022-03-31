<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class OurNeed extends Model
{
    public $relationships = array('images');
    public $fillable = [
        'title',
        'description',
        'quantity',
        'category',
        'due_date',
        'urgency'
    ];
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function images()
    {
        return $this->embedsMany('App\Image');
    }

    public function shares()
    {
        return $this->embedsMany('App\Share','shareable');
    }

     public function likes()
    {
        return $this->embedsMany('App\Like','likeable');
    }

    public function comments()
    {
        return $this->embedsMany('App\Comment','commentable');
    }
}
