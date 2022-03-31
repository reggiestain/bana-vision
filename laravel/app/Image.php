<?php

namespace App;

use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model;

class Image extends Model
{

    public $incrementing = true;
    protected $fillable = [
    	'path',
		'name'
	];
    public function imageable()
    {
        return $this->morphTo();
    }
}
