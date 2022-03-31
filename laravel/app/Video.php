<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Video extends Model
{
	public function videoable()
	{
		return $this->morphTo();
	}
    
}
