<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\School;
use App\SchoolClass;
use App\SchoolStudent;
use App\SubjectAttended;
use App\Teacher;
use App\Curriculumn;
use Carbon\Carbon;

class AttendanceController extends Controller
{
	/************************************************************
	* TAKE ATTENDANCE REGISTER
	*************************************************************
	*@params Request
	*@return view
	*/
    public function takeAttendance(Request $request)
    {
    	$this->validate($request,[
    		
    		'day' => 'required|array',
    		'status' => 'required|array',
    		'school_id' =>'required|array',
    		'attendable_id' =>'required|array',
    		'attendable_type' =>'required|array',
    		'week' =>'required|array',
    		'time' => 'required|array',
    		'curriculumn_id'  => 'required|array',
        
            'day.*' => 'required|string|min:3|max:4',
            'status.*' => 'required|numeric|min:0|max:1',
            'school_id.*' =>'required|numeric|min:1',
            'attendable_id.*' =>'required|numeric|min:1',
            'attendable_type.*' =>'required|string',
            'week.*' =>'required|numeric|min:1|max:52',
            'time.*' => 'required|string',
            'curriculumn_id.*'  => 'required|numeric|min:1',
    	]);

    foreach($request['attendable_id'] as $key=>$attendee)
    {
        $day = $request['day'][$key];
        //updates the attendance
        $updateAttendance = function($form_day,$status){
            $arr[$form_day] = $status;
            return $arr;
        };

        
    	$attendance = Attendance::updateOrCreate([
   			//check to see if
    		'school_id'   => $request['school_id'][$key],
    		'attendable_id' => $request['attendable_id'][$key],
    		'attendable_type' => $request['attendable_type'][$key],
    		'week' => $request['week'][$key],
    	],$updateAttendance($request['day'][$key],$request['status'][$key]));

    	//create an attended
    	$subject_attended = SubjectAttended::firstOrCreate([
    	'attendance_id' => $attendance->id,
    		'day' => $request['day'][$key],
    		'time' => $request['time'][$key],
    		'curriculumn_id' => $request['curriculumn_id'][$key],
    	
    ]
);

    }

    	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
    }
}
