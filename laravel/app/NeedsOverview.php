<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class NeedsOverview extends Model
{
	protected $fillable = ['caption', 'body','school_id'];

    public function images()
    {
        return $this->embedsMany('App\Image');
    }
}
