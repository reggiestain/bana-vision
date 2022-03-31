<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\Excess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExcessController extends Controller
{
    
   
   


    //GET THE SCHOOLPAGE


	public function getGeneralExcessPage()
	{
		
		return view('errors.unavailable');
	}

	public function getOurExcessPage(User $user)
	{
		return view('excess.ourExcessPage',['userIdNo' => $user]);
	}
	

   
}