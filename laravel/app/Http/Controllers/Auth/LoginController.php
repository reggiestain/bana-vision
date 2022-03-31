<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /*var $myreq;
    
    protected function redirectTo()
    { 
        $slug = Auth::user()->slug;
        $request = request(); 
        if(!$request->expectsJson()) 
            { 
                // you may want to swap this with $request->isJson() depending on the HTTP headers for your app
                return '/'.$slug.'/feed';
            }

            // common logic here (including validation); store result as $result

            if($request->expectsJson()) 
            { 
                // based on HTTP headers as above
                return 'SchoolProfilePage'.$id;
            } 
            else 
            {
                return view('register', $result);
            }
        
    }*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    

}
