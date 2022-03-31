<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class SchoolStudent extends Model
{
     protected $hidden = [
        'id_number',
    ];
    public $fillable = [
        'name',
        'surname',
        'id_number',
        'guardian',
        'grade',
        'class',
        'year',
        'student_number',
        'school_id',
        'disability',
        'gender',
        'special_medication',
        'medical_condition',
        'previous_school',
        'previous_grade'
    ];
    
    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    public function studentsProjects()
    {
    	return $this->belongsToMany('App\StudentsProject', 'students_students_projects');
    }

    public function studentAwards()
    {
        return $this->hasMany('App\StudentAward');
    }

    public function FeaturedStudents()
    {
        return $this->hasMany('App\FeaturedStudent');
    }

    public function requestedBook()
    {
        return $this->morphMany('App\RequestedBook', 'requestable');
    }

    public function checkedOutBook()
    {
        return $this->morphMany('App\CheckedOutBook', 'checkedable');
    }

    public function attendance()
    {
        return $this->morphMany('App\Attendance', 'attendable');
    }

    public function loanedBook()
    {
    	return $this->hasMany('App\LoanedBook');
    }

    public function studentMisconduct()
    {
    	return $this->hasMany('App\StudentMisconduct');
    }

    public function guardian()
    {
    	return $this->hasMany('App\Guardian');
    }

    public function images()
    {
        return $this->embedsMany('App\Image');
    }
}
