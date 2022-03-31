<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class SchoolClass extends Model
{
    public function school()
    {
    	return $this->belongsto('App\School');
    }
}
