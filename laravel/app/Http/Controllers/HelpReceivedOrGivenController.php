<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\HelpReceivedOrGiven;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HelpReceivedOrGivenController extends Controller
{
    
   
   


    //GET THE SCHOOLPAGE


	public function getGeneralHelpReceivedOrGivenPage()
	{
		
		return view('errors.unavailable');
	}

	public function getHelpReceivedOrGivenPage(User $user)
	{
		return view('school.help_received_or_given.helpReceivedOrGivenPage',['userIdNo' => $user]);
	}
	

   
}