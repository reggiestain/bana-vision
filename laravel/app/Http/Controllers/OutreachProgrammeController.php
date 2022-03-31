<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\OutreachProgramme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OutreachProgrammeController extends Controller
{
    
   
   


    //GET THE SCHOOLPAGE


	public function getGeneralOutreachProgrammePage()
	{
		
		return view('school.generalOutreachProgrammePage');
	}

	public function getOutreachProgrammePage($userId)
	{
		$userIdNumber = User::where('id',$userId)->first();

		return view('school.outreachProgrammePage',['userIdNo' => $userIdNumber]);
	}
	

   
}