<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class BanaStaff extends Model
{
    public function user()
    {
        return $this->morphMany('App\User', 'usable');
    }
}
