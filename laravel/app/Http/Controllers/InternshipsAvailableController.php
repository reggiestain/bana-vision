<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\InternshipsAvailable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InternshipsAvailableController extends Controller
{
    
   
   


    //GET THE SCHOOLPAGE


	public function getGeneralInternshipsAvailablePage()
	{
		
		return view('errors.unavailable');
	}

	public function getInternshipsAvailablePage(User $user)
	{
		return view('internshipsAvailablePage',['userIdNo' => $user]);
	}
	

   
}