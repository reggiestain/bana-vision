<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\TeacherProficiency;
use App\Staff;
use App\User;
use App\Post;
use App\Setting;
use App\Image;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
      /***********************************************************
  *
  ************************************************************
  *
  */
  public function createStaff(Request $request)
  {

    $this->validate($request,[
      'name' => 'required|string',
      'email' => 'required|email|unique:users',
      'password' => 'required|string',
      'position'=> 'required|string',
      'awards' => 'string|required_with:is_teacher',
      'about' => 'string',
      'experience' => 'required_with:is_teacher|array|min:1',
      'experience.*' => 'required_with:is_teacher|numeric|min:1',
      'curriculumn_id' => 'required_with:is_teacher|array|min:1',
      'curriculumn_id.*' => 'required_with:is_teacher|numeric|min:1',

    ]);

    $auth_user = Auth::user();
    $staff= new Staff();
    $staff->position = $request['position'];
    $staff->awards = $request['awards'];
    $staff->about = $request['about'];
    $staff->name = $request['name'];
    $staff->surname = $request['surname'];
    $staff->email = $request['email'];
    if($auth_user->usable->staff()->save($staff))
    {
      $picture_type = 'profile';
      $file = $request->file('image');

           #upload the image as a post 

      $image = new Image();
      $image->path = $auth_user->slug.'/staff/'.$staff->id.'/'.$picture_type.'/';
      $image->name = $file->extension();
      $staff->images()->save($image);
      $image->update(['name'=>$image->id.'.'.$image->name]);

      # use helper to store the image 
      \Imagery::setImage($file->extension(),$file,'profile','staff',$auth_user,$image->id,$staff);
      //\Imagery::setImage($file->extension(),$file,'profile','students',$school_student,$image->id);
    }

    if($request['allow_privelleges'])//staff member is allowed privelleges
    {
      # create new account for the staff member
      $user = new User();
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->password = bcrypt($request['password']);
      $user->slug = str_slug($request['name'].' '.$request['surname'], '.');
      $user->activation_code = str_random(30).time();
      $user->save();
      $staff->update(['user_id'=>$user->id]); 

    }

    $teacher = null;
    if($request['is_teacher'] == true)
    {
      $teacher = new Teacher();
       /// $teacher->staff_id = $staff->id;
      $staff->teacher()->save($teacher);

      foreach ($request['curriculumn_id'] as $key => $curriculumn) 
      {
        $teacher_proficiency = new TeacherProficiency();
        $teacher_proficiency->curriculumn_id = $curriculumn;
        $teacher_proficiency->experience = $request['experience'][$key];
        $teacher->teacherProficiency()->save($teacher_proficiency); 
      }
    }

    return response()->json([
      'message'=>'Teacher successfully added!!',
      'post' => $staff
    ]);
  }

    public function createTeacherProficiency(Request $request)
    {
    	$this->validate($request,[
			'teacher_id' =>'required|numeric',
			'curriculumn_id' =>'',
			'experience' =>'',
    	]);

    	$teacher_proficiency = new TeacherProficiency();
    	$teacher_proficiency->teacher_id = $request['teacher_id'];
    	$teacher_proficiency->curriculumn_id = $request['curriculumn_id'];
    	$teacher_proficiency->experience = $request['experience'];
    	$teacher_proficiency->save();
    	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
    }
}


