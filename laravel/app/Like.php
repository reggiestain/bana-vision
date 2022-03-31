<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Like extends Model
{
    public function likeable()
    {
        return $this->morphTo();
    }
    
}
