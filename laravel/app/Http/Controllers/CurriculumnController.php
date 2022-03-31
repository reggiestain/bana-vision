<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curriculumn;
use App\School;
use App\User;

class CurriculumnController extends Controller
{
    /************************************************************
    *
    *************************************************************
    *
    *
    */
    public function createCurriculumn(Request $request)
    {
    	$this->validate($request,[
			'school_id' =>'required|numeric|min:1',
			'subject' =>'required|string',
			'grade' =>'required|numeric|max:12',
			'has_practicals' =>'required|numeric|min:0|max:1',
            'description'=>'required|string'
    	]);

    	$curriculumn = new Curriculumn();
    	$curriculumn->school_id=$request['school_id'];
    	$curriculumn->subject=$request['subject'];
    	$curriculumn->grade=$request['grade'];
    	$curriculumn->has_practicals=$request['has_practicals'];
        $curriculumn->description = $request['description'];
    	$curriculumn->save();
    	return redirect()->back()->with(['message'=>'Thank you for your input!!']);
    }

    /************************************************************
    *
    *************************************************************
    *
    *
    */
    public function getCurriculumn(User $user)
    {
        $curriculumn = Curriculumn::where('school_id',School::find($user->usable_id)->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('school.admin.adminCurriculumnPage',['curriculumn'=>$curriculumn,'userIdNo'=> $user]);
    }

    /************************************************************
    *
    *************************************************************
    *
    *
    */
    public function deleteCurriculumn(User $user,$curriculumn_id)
    {
       
        $curriculumn = Curriculumn::find($curriculumn_id);
        $curriculumn->delete();
        return redirect()->back()->with(['message'=>'you have deleted the subject']);
    }

    /************************************************************
    *
    *************************************************************
    *
    *
    */
    public function editCurriculumn(Request $request)
    {
        $this->validate($request,[
            'curriculumn_id'=>'required|numeric',
            'subject'=>'string',
            'grade'=>'numeric',
            'has_practicals'=>'numeric',
            'description'=>'text'
        ]);

        $curriculumn = Curriculumn::find($request['curriculumn_id']);
        foreach ($request as $key => $req) 
        {
            dd($curriculumn->$req);
        }
    }

}
