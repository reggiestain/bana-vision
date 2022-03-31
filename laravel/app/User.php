<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function getRouteKeyName()
   {
      return 'slug'; // use the 'product.slug' column for look ups within the database
   }

    protected $fillable = [
        'name', 'email', 'password', 'status', 'activation_code','usable_id','usable_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','activation_code',
    ];

    public function usable()
    {
        return $this->morphTo();
    }

    public function posts()
    {
        return $this->embedsMany('App\Post');
    }

    public function imageable()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

     public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    
     public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    public function events()
    {
        return $this->hasMany('App\OurEvent');
    }


    public function ourNeeds()
    {
        return $this->hasMany('App\OurNeeds');
    }

    public function internshipsAvailable()
    {
        return $this->hasMany('App\InternshipsAvailable');
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

     public function bursaries()
    {
        return $this->hasMany('App\Bursary');
    }

    public function settings()
    {
        return $this->embedsOne('App\Setting');
    }

    public function shares()
    {
        return $this->hasMany('App\Share');
    }

    public function followers()
    {
        return $this->embedsMany('App\Follower');//users who follow them
    }

    public function follows()
    {
        return $this->embedsMany('App\Follow');//users they follow
    }
  
}
