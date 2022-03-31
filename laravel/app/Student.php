<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model;

class Student extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gender','birthdate','sector','school_id','grade','zlto_my_uuid_id'];
    public function user()
    {
        return $this->morphMany('App\User', 'usable');
    }
  
    public function school()
    {
    	return $this->belongsTo('App\School');
    }
    
    public function schoolStudent()
    {
        return $this->hasOne('App\SchoolStudent');
    }

}
