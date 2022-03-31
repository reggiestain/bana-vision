<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'registration_number',
        'business_entity',
        'registration_country',
        'registered_address_country',
        'registered_address_province',
        'registered_address_town',
        'registered_address_address',
        'registered_address_area_code',
        'business_place_country',
        'business_place_province',
        'business_place_town',
        'business_place_address',
        'business_place_area_code',
        'telephone',
        'web_url',
        'values',
        'services',
        'sector',
        'year_established',
        'mission',
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
