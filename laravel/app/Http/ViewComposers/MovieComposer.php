<?php 
   

    namespace App\Http\ViewComposers;
    use Illuminate\View\View;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    class MovieComposer
    {
    	
    	/**
    	*    create a movie composer.
    	*    @return void
    	*/
    	public function __construct()
    	{
    		
    		
    	}

    	/**
    	* Bind data to the view
    	* @param View $view
    	* @return void
    	*/
    	public function compose(View $view)
    	{
           
           $query = DB::table('users')->where('usable_type','App\School')->get();
           \View::share('schools', $query);
           /*
            * If user is uathenticated display their messages
            */
           if(Auth::check())
           {
              $number_notifications = 0;
              /* FIX MONGODB DATABASE NOTIFICATIONS
              foreach (Auth::User()->unreadNotifications as $notification) 
              {
                $number_notifications++;
              }*/
              $msgs = DB::table('messages')->where('sendTo_id',Auth::user()->id)->where('seen',0)->count();
              \View::share('numberMessages', $msgs);
              \View::share('numberNotifications', $number_notifications);
           }
           if (isset($view->getData()['userIdNo']))
           {
    		     $userPassedId = $view->getData()['userIdNo'];
            //$userPassedId = "hello";
            
             $countMsgs = 0;
            // foreach ($msgs as $msg) 
            // {
               //  $countMsgs = $countMsgs + 1;
            // }
             
    		    $view->with(['userPassedId'=>$userPassedId]);

    	    }
    	    else
    	    {
    	    	$userPassedId = "hello";
    		   $view->with('userPassedId',$userPassedId);
    	    }
    	}
    	
    }
