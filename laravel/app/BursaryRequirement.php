<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class BursaryRequirement extends Model
{
	public $fillable = ['requirement'];
   public function bursary()
    {
    	return $this->belongsTo('App\Bursary');
    }
}
