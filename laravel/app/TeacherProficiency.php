<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class TeacherProficiency extends Model
{
    public function teacher()
    {
    	return $this->belongsTo('App\Teacher');
    }

    public function curriculumn()
    {
    	return $this->belongsTo('App\Curriculumn');
    }
}
