<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Setting extends Model
{
	protected $fillable = [
        'user_id','profile_pic_id','cover_pic_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
