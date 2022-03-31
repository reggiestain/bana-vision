<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'origin_country',
        'operation_area_country',
        'operation_area_province',
        'operation_area_town',
        'operation_area_area_code',
        'headquarters_country',
        'headquarters_province',
        'headquarters_town',
        'headquarters_area_code',
        'headquarters_address',
        'telephone',
        'registration_number',
        'organization_type',
        'focus',
        'web_url',
    ];
    public function user()
    {
        return $this->morphMany('App\User', 'usable');
    }

      public function likeable()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function staff()
    {
        return $this->hasMany('App\Staff');
    }
    public function shares()
    {
        return $this->morphMany('App\Share','shareable');
    }
}
