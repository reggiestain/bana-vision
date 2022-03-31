<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class School extends Model
{
    use \Illuminate\Auth\Authenticatable;
    protected $fillable = [
        'user_name',
        'user_slug',
        'address',
        'web_url',
        'about',
        'history',
        'principal',
        'number_students',
        'number_teachers',
        'country',
        'suburb',
        'province',
        'district',
        'coeducational',
        'pass_rate',
        'special_needs',
        'telephone',
        'k_12',
        'sector',
        'funding',
        'bana_email_address',
        'bana_email_password',
        'natEmis',
        'province_cd',
        'status',
        'type_ped',
        'phase_ped',
        'specialization',
        'owner_land',
        'owner_buildings',
        'ex_dept',
        'pay_point_no',
        'component_no',
        'exam_no',
        'exam_centre',
        'new_lat',
        'new_long',
        'gis_source',
        'district_municipality_name',
        'local_municipality_name',
        'ward_id',
        'sp_code',
        'sp_name',
        'ei_district',
        'ei_circuit',
        'addressee',
        'township_village',
        'town_city',
        'street_address',
        'postal_address',
        'section21',
        'section21_funct',
        'quintile',
        'nas',
        'nodal_area',
        'registration_date',
        'no_fee_school',
        'allocation',
        'demarcation_from',
        'demarcation_to',
        'old_nat_emis',
        'new_nat_emis',
    ];
    protected $hidden = ['bana_email_password'];
    public $timestamps = false;
    public function user()
    {
        return $this->morphMany('App\User', 'usable');
    }

    public function events()
    {
        return $this->embedsMany('App\OurEvent');
    }

    public function likes()
    {
        return $this->embedsMany('App\Like');
    }

    public function studentProjects()
    {
        return $this->embedsMany('App\StudentsProject','student_projects');
    }

    public function featuredStudents()
    {
        return $this->embedsMany('App\FeaturedStudent','featured_students');
    }

    public function studentAwards()
    {
        return $this->embedsMany('App\StudentAward','student_awards');
    }

    public function students()
    {
        return $this->embedsMany('App\Student');
    }

    public function needs()
    {
        return $this->embedsMany('App\OurNeed');
    }

    public function ratings()
    {
        return $this->embedsMany('App\Rating');
    }

    public function staff()
    {
        return $this->embedsMany('App\Staff');
    }

    public function bursaries()
    {
        return $this->embedsMany('App\Bursary');
    }

    public function needs_overview()
    {
        return $this->embedsOne('App\NeedsOverview','needs_overview');
    }

    public function needs_gratitude()
    {
        return $this->embedsMany('App\NeedsGratitude','needs_gratitude');
    }

    public function attendance()
    {
        return $this->embedsMany('App\Attendance');
    }

    public function schoolStudents()
    {
        return $this->embedsMany('App\SchoolStudent','students');
    }

    public function curriculumn()
    {
        return $this->embedsMany('App\Curriculumn');
    }

    public function schoolclass()
    {
        return $this->embedsMany('App\SchoolClass');
    }

    public function teacher()
    {
        return $this->embedsMany('App\Teacher');
    }

    public function book()
    {
        return $this->embedsMany('App\Book');
    }

    public function checkedOutBook()
    {
        return $this->embedsMany('App\CheckedOutBook');
    }

    public function libraryBook()
    {
        return $this->embedsMany('App\LibraryBook');
    }

    public function loanedBook()
    {
        return $this->embedsMany('App\LoanedBook');
    }

    public function requestedBook()
    {
        return $this->embedsMany('App\Book');
    }

    public function studentMisconduct()
    {
        return $this->embedsMany('App\StudentMisconduct');
    }

    public function guardian()
    {
        return $this->embedsMany('App\Guardian');
    }

    public function shares()
    {
        return $this->embedsMany('App\Share');
    }

    public function facilities()
    {
        return $this->embedsMany('App\Facility');
    }

    public function activities()
    {
        return $this->embedsMany('App\Activity');
    }
}
