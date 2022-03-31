<?php

namespace App\Http\Controllers;
use App\User;
use App\Student;
use App\School;
use App\OurEvent;
use App\Like;
use App\Comment;
use App\Image;
use App\Message;
use App\Post;
use App\Video;
use App\Bursary;
use App\SchoolStudent;
use App\Share;
use App\Staff;
use App\Announcement;
use App\News;
use App\Facility;
use App\Activity;
use App\OurNeed;
use App\Notifications\UpdateProfilePicture;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
//use Webklex\IMAP\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

/*        // Create a client with a base URI
$client = new Client(['base_uri' => '']);
// Send a request to https://foo.com/api/test
$response = $client->get('https://bana.vision:2083/execute/Email/add_pop?email=kaygee&password=Accidental1870&quota=500&domain=schools.bana.vision&skip_update_db=1',
        [
            'headers' => [
                'Authorization' =>' cpanel wwwbana:SSZTGX8BXA2HKRHVGHNYVO95VN539UYX',
            ],
        ]);*/

      //$this->zlto();
      //$this->zlto_get_stores();

       $announcements = Announcement::limit(3)->latest()->get();
       $news = News::limit(3)->latest()->get();

        return view('layouts.masterProfile',['announcements'=>$announcements,'news'=>$news]);
    }
    /**
     * Show the profile picture.
     *
     * 
     */
    public function getSchoolProfilePage(User $user,Request $request)
    {
        
        $userID = $user;

        # get all the cover photos
       
        $cover_ph = Storage::files($user->slug.'/cover/');  //get all the files in the folder
        $cover_photos = collect();
        foreach ($cover_ph as $key => $photo) 
        {
            $photo = explode('/', $photo);
            $photo = $photo[2];
            $pst = $userID->posts()
            ->select('images.0.name',$photo)
            ->first();
            
            $cover_photos->push($pst); //replace all the files with images
        }
    
        # get all the profile photos

        $profile_ph = Storage::files($user->slug.'/profile/');
        $profile_photos = collect();
        foreach ($profile_ph as $key => $photo) 
        {
            $photo = explode('/', $photo);
            $photo_name = $photo[2];
            $pst = $userID->posts()
            ->select('images.0.name',$photo_name)
            ->first();
            $profile_photos->push($pst);
        }
        
        # get all the post photos
        
        $post_ph = Storage::files($user->slug.'/post/');
        $post_photos = collect();
        foreach ($post_ph as $key => $photo) 
        {
            $photo = explode('/', $photo);
            $photo = $photo[2];
            if(Image::where('name',$photo)->first())
            {
               $post = Image::where('name',$photo)
               ->first()
               ->imageable; 
               $pst = Post::where('id',$post->id)
               ->with('images')
               ->first();
               $post_photos->push($pst);
            }
            
            
        }

         # get all the post videos
        
        $post_vi = Storage::files($user->slug.'/post/');
        $post_videos = collect();
        foreach ($post_vi as $key => $video) 
        {
            $video = explode('/', $video);
            $video = $video[2];
            if(Video::where('name',$video)->first())
            {
               $post = Video::where('name',$video)
               ->first()
               ->videoable; 
               $post_videos->push($post);
            }
            
            
        }


       
        $events = OurEvent::where('user_id',$userID->id)
        ->paginate(25);

        //
        $following = new Collection;
        foreach ($userID->follows as $follow) 
        {
            $following->push( User::find($follow->user_id));
        }



        //
        $followers = new Collection;
        foreach ($userID->followers as $follower) 
        {
            $followers->push( User::find($follower->user_id));
        }
        
        $comments = Comment::where('commentable_type','App\Event')
        ->get();
        
        $posts = Post::orderBy('created_at','desc')
        ->get();

        /***********************************closure function to get pictures when scrolling***********************/
        $ajaxPhotos = function($request) use($cover_photos,$profile_photos,$post_photos) {
            //for lazy loading when the user scrolls down
            if ($request->ajax()) 
            {
                if($request->filled('page1')) //if the request is from cover tab
                {
                    $posts =$cover_photos->forPage($_GET['page1'], 9);
                    $myarr = array( );
                    foreach ($posts as $key => $value) 
                    {
                        $value = $value->toArray();
                        array_push($myarr, $value);
                    }

                    //$view = view('coverPhotoData',['userIdNo' => $userID,'cover_photos'=>$cover_photos->forPage($_GET['page1'], 9)])->render();
                    return response()->json(['posts'=>$myarr]);
                }
                else if($request->filled('page2'))
                {
                    $posts = $profile_photos->forPage($_GET['page2'], 9);
                    $myarr = array( );
                    foreach ($posts as $key => $value) 
                    {
                        $value = $value->toArray();
                        array_push($myarr, $value);
                    }
                    //$view = view('user.profilePhotoData',['userIdNo' => $userID,'profile_photos'=>$profile_photos->forPage($_GET['page2'], 9)])->render();
                    return response()->json(['posts'=>$myarr]);
                }
                else
                {
                    $posts = $post_photos->forPage($_GET['page3'], 9);
                    $myarr = array( );
                    foreach ($posts as $key => $value) 
                    {
                        $value = $value->toArray();
                        array_push($myarr, $value);
                    }
                     //$view = view('otherPhotoData',['userIdNo' => $userID,'post_photos'=>$post_photos->forPage($_GET['page3'], 9)])->render();
                    return response()->json(['posts'=>$myarr]);
                }

            } //end ajax request
        };



        /*****************************************switch between different type of users******************************************/
        switch ($userID->usable_type) {
            case 'App\School':
            //facilities
            $facilities = Facility::where('school_id',$userID->usable_id)
            ->with('images')
            ->paginate(9);
            //activities
            $activities = Activity::where('school_id',$userID->usable_id)
            ->with('images')
            ->paginate(9);
            //staff
            $staff = $userID->usable->staff();
            //$ajaxPhotos($request);
            /*//for lazy loading when the user scrolls down
            if ($request->ajax()) 
            {
                if($request->filled('page1')) //if the request is from cover tab
                {
                    $posts =$cover_photos->forPage($_GET['page1'], 9);
                    $myarr = array( );
                    foreach ($posts as $key => $value) 
                    {
                        $value = $value->toArray();
                        array_push($myarr, $value);
                    }

                    //$view = view('coverPhotoData',['userIdNo' => $userID,'cover_photos'=>$cover_photos->forPage($_GET['page1'], 9)])->render();
                    return response()->json(['posts'=>$myarr]);
                }
                else if($request->filled('page2'))
                {
                    $posts = $profile_photos->forPage($_GET['page2'], 9);
                    $myarr = array( );
                    foreach ($posts as $key => $value) 
                    {
                        $value = $value->toArray();
                        array_push($myarr, $value);
                    }
                    //$view = view('user.profilePhotoData',['userIdNo' => $userID,'profile_photos'=>$profile_photos->forPage($_GET['page2'], 9)])->render();
                    return response()->json(['posts'=>$myarr]);
                }
                else
                {
                    $posts = $post_photos->forPage($_GET['page3'], 9);
                    $myarr = array( );
                    foreach ($posts as $key => $value) 
                    {
                        $value = $value->toArray();
                        array_push($myarr, $value);
                    }
                     //$view = view('otherPhotoData',['userIdNo' => $userID,'post_photos'=>$post_photos->forPage($_GET['page3'], 9)])->render();
                    return response()->json(['posts'=>$myarr]);
                }

            } //end ajax request*/


            $rating = $userID->usable->ratings->avg('rating');
            return view('user.SchoolProfilePage',[
                'userIdNo' => $userID,
                'comments' => $comments,
                'events' => $events,
                'followings'=>$following,
                'followers'=>$followers,
                'facilities'=>$facilities,
                'activities'=>$activities,
                'rating'=>$rating,
                'cover_photos'=>$cover_photos->forPage(1, 9),
                'profile_photos'=>$profile_photos->forPage(1, 9),
                'post_photos'=>$post_photos->forPage(1, 9),
                'post_videos'=>$post_videos
            ]);
                break;

            
            case 'App\Teacher':
                $teachers_students = new Collection(); 
                if(Auth::user()->usable->teacher->first() != null && Auth::id() == $userID->id) //if its a teacher and is authorised
                {
                //$userID->staff->teacher()->count()
                    foreach (Auth::user()->usable->teacher->first()->teacherProficiency as $key => $tp) 
                    {
                        $stu = SchoolStudent::where('school_id',Auth::user()->usable->first()->id)
                        ->where('grade',$tp->curriculumn->grade)
                        ->get();
                        foreach ($stu as $key => $st) 
                        {
                            $teachers_students->push($st);
                        }
                    }
                //$students = SchoolStudent::where('school_id',Auth::id()->usable->school_id)

                    $ajaxPhotos($request);
                    /*//for lazy loading when the user scrolls down
                    if ($request->ajax()) 
                    {
                        if($request->filled('cover')) //if the request is from cover tab
                        {
                            $view = view('coverPhotoData',[
                                'userIdNo' => $userID,
                                'cover_photos'=>$cover_photos->forPage($_GET['cover'], 9)
                            ])->render();
                            return response()->json(['html'=>$view]);
                        }
                        elseif ($request->filled('profile')) 
                        {
                           $view = view('user.profilePhotoData',[
                            'userIdNo' => $userID,
                            'profile_photos'=>$profile_photos->forPage($_GET['profile'], 9)
                        ])->render();
                           return response()->json(['html'=>$view]); 
                        }
                        else
                        {
                            $view = view('otherPhotoData',[
                                'userIdNo' => $userID,
                                'post_photos'=>$post_photos->forPage($_GET['other'], 9)
                            ])->render();
                            return response()->json(['html'=>$view]);
                        }
                    }//end ajax request*/

                    return view('user.SchoolProfilePage',[
                        'userIdNo' => $userID,
                        'comments' => $comments,
                        'events' => $events,
                        'followings'=>$following,
                        'followers'=>$followers,
                        'profile_photos'=>$profile_photos->forPage(1, 9),
                        'post_photos'=>$post_photos->forPage(1, 9),
                        'cover_photos'=>$cover_photos->forPage(1, 9),
                        'teachers_students'=>$teachers_students,
                        'post_videos'=>$post_videos
                    ]);
                } //end if teacher and authorised
                break;



            case 'App\Student':
                return view('user.SchoolProfilePage',[
                    'userIdNo' => $userID,
                    'comments' => $comments,
                    'events' => $events,
                    'followings'=>$following,
                    'followers'=>$followers,
                    'profile_photos'=>$profile_photos->forPage(1, 9),
                    'post_photos'=>$post_photos->forPage(1, 9),
                    'cover_photos'=>$cover_photos->forPage(1, 9),
                    'rating'=>null,
                    'post_videos'=>$post_videos]);
                break;

            case 'App\Organization':
                $rating = null;

                $userIdNo = User::with('usable')->find($userID->id);
                return view('user.SchoolProfilePage',[
                    'userIdNo' => $userIdNo,
                    'comments' => $comments,
                    'events' => $events,
                    'followings'=>$following,
                    'followers'=>$followers,
                    'rating'=>$rating,
                    'cover_photos'=>$cover_photos->forPage(1, 9),
                    'profile_photos'=>$profile_photos->forPage(1, 9),
                    'post_photos'=>$post_photos->forPage(1, 9),
                    'post_videos'=>$post_videos
                ]);
                break;

            case 'App\Company':
                 $rating = null;

                $userIdNo = User::with('usable')->find($userID->id);
                return view('user.SchoolProfilePage',[
                    'userIdNo' => $userIdNo,
                    'comments' => $comments,
                    'events' => $events,
                    'followings'=>$following,
                    'followers'=>$followers,
                    'rating'=>$rating,
                    'cover_photos'=>$cover_photos->forPage(1, 9),
                    'profile_photos'=>$profile_photos->forPage(1, 9),
                    'post_photos'=>$post_photos->forPage(1, 9),
                    'post_videos'=>$post_videos
                ]);
                break;

            case 'App\Staff':
                $ajaxPhotos($request);
                /*//for lazy loading when the user scrolls down
                    if ($request->ajax()) 
                    {
                        if($request->filled('cover')) //if the request is from cover tab
                        {
                            $view = view('coverPhotoData',[
                                'userIdNo' => $userID,
                                'cover_photos'=>$cover_photos->forPage($_GET['cover'], 9)
                            ])->render();
                            return response()->json(['html'=>$view]);
                        }
                        elseif ($request->filled('profile')) 
                        {
                           $view = view('user.profilePhotoData',[
                                'userIdNo' => $userID,
                                'profile_photos'=>$profile_photos->forPage($_GET['profile'], 9)
                            ])->render();
                           return response()->json(['html'=>$view]); 
                        }
                        else
                        {
                            $view = view('otherPhotoData',[
                                'userIdNo' => $userID,
                                'post_photos'=>$post_photos->forPage($_GET['other'], 9)
                            ])->render();
                            return response()->json(['html'=>$view]);
                        }
                    } // end ajax request
*/
                    return view('user.SchoolProfilePage',[
                        'userIdNo' => $userID,
                        'comments' => $comments,
                        'events' => $events,
                        'followings'=>$following,
                        'followers'=>$followers,
                        'profile_photos'=>$profile_photos->forPage(1, 9),
                        'post_photos'=>$post_photos->forPage(1, 9),
                        'cover_photos'=>$cover_photos->forPage(1, 9),
                        'post_videos'=>$post_videos
                    ]);
                break;


            default:
                //for lazy loading when the user scrolls down
                    if ($request->ajax()) 
                    {
                        if($request->filled('cover')) //if the request is from cover tab
                        {
                            $view = view('user.coverPhotoData',[
                                'userIdNo' => $userID,
                                'cover_photos'=>$cover_photos->forPage($_GET['cover'], 9)
                            ])->render();
                            return response()->json(['html'=>$view]);
                        }
                        elseif ($request->filled('profile')) 
                        {
                           $view = view('user.profilePhotoData',[
                            'userIdNo' => $userID,
                            'profile_photos'=>$profile_photos->forPage($_GET['profile'], 9)
                        ])->render();
                           return response()->json(['html'=>$view]); 
                        }
                        else
                        {
                            $view = view('otherPhotoData',[
                                'userIdNo' => $userID,
                                'post_photos'=>$post_photos->forPage($_GET['other'], 9)
                            ])->render();
                            return response()->json(['html'=>$view]);
                        }
                    }

                return view('user.SchoolProfilePage',[
                    'userIdNo' => $userID,
                    'comments' => $comments,
                    'events' => $events,
                    'followings'=>$following,
                    'followers'=>$followers,
                    'profile_photos'=>$profile_photos->forPage(1, 9),
                    'post_photos'=>$post_photos->forPage(1, 9),
                    'cover_photos'=>$cover_photos->forPage(1, 9),
                    'rating'=>null,
                    'post_videos'=>$post_videos]);
                break;
        }//end switch
        
    }
    /**
     * [getNotifications description]
     * @return [type] [description]
     */
    public function getNotifications()
    {   
        
        Auth::User()->unreadNotifications->markAsRead();
        return view('user.notifications',['notifications' => Auth::User()->notifications]); 
    }

    /*****************************************************************************
    * Get the news feed of the currently logged in user
    ******************************************************************************
    *
    *
    */
    public function getFeed(User $user,Request $request)
    {
       
        $usersLikeds = Like::where('user_id',$user->id)
        ->where('likeable_type','App\User')
        ->where('like',1)
        ->get();
        $news_feed = new Collection;
        $post_types = ['events','bursaries','needs'];

        //these are configured to be only one because user doesnt need to see all of their previous post
        if ($user->usable_type != 'App\Student' || $user->usable_type != 'App\Staff')
        {

            foreach ($post_types as $post_type) 
            {

                $posts = $user->usable->$post_type; //get the posts

                foreach ($posts as $post) //add a post type to each post
                {
                    $post->post_type = $post_type;
                    $news_feed->push($post);
                }
            }
            
        }
        /*
        $post = $user->posts;

        if($post)
        {
            foreach ($post as $pst) 
            {
                $pst->pst_type = 'App\Post';
                $news_feed->push($pst);
            }
            
            
        }
        
        #for events
        foreach ($usersLikeds as $usersLiked) 
        {   
            #for events
            $events = OurEvent::where('user_id',$usersLiked->likeable_id)
            ->with('user')
            ->with('images')
            ->latest()
            ->limit(5)
            ->get();

            if($events)
            {
                foreach($events as $event)
                {
                    $event->setAttribute('post_type', get_class($event));
                    $news_feed->push($event);
                }
            }
        
            #for bursaries
      
            $bursaries = Bursary::where('user_id',$usersLiked->likeable_id)
            ->with('images')
            ->with('requirements')
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

            if($bursaries)
            {
                foreach ($bursaries as $key => $bursary) 
                {
                    $bursary->setAttribute('post_type', get_class($bursary));
                    $news_feed->push($bursary);
                }
            }

            #for shares
        
            $shares = Share::where('user_id',$usersLiked->likeable_id)->get();
            if($shares)
            {
                foreach ($shares as $key => $share) 
                {
                    if($share)
                    {

                        $sharedPost = $share->shareable;
                        $relationships = $sharedPost->relationships; //the relationships in the models
                        if ($relationships) 
                        {
                            foreach ($relationships as $key => $rel)
                            {
                                $rel_levels = explode("~",$rel);

                                $rela = $sharedPost;
                                //
                                foreach ($rel_levels as $key => $level) 
                                {
                                    $rela = $rela->$level;
                                }
                                $sharedPost->setAttribute(end($rel_levels), $rela);
                            }
                        }

                        $sharedPost->setAttribute('shared',true);
                        $sharedPost->setAttribute('shared_user_id',$share->user->id);
                        $sharedPost->setAttribute('shared_user_slug',$share->user->slug);
                        $sharedPost->setAttribute('shared_user_name',$share->user->name);
                        $sharedPost->setAttribute('post_type', get_class($sharedPost));
                        $sharedPost->setAttribute('user', $sharedPost->user);
                        //$sharedPost->setAttribute('image', $sharedPost->images);
                        $news_feed->push($sharedPost);
                    }
                }
            }
        }
        */
        # if n+1 page is requested

            if($request->filled('page1'))
            { dd("nah fam");
                $posts = $news_feed->forPage($_GET['page1'], 6);
                $myarr = array( );
                foreach ($posts as $key => $value) 
                {
                    $value = $value->toArray();
                    array_push($myarr, $value);
                }
                //$view = view('user.newsfeedData',['userIdNo' => $user,'news_feed'=>$news_feed->forPage($_GET['page'], 6)])->render();
                           return response()->json(['posts'=>$myarr]); 
            }


     return response()->json(['user' => $user,'posts1'=>$news_feed->all()]);
    }

    /**************************************************************************************
    * Bana about us page
    ***************************************************************************************
    *
    *
    *
    */
    public function getAboutUsPage()
    {
        return view('bana.aboutUsPage');
    }

    public function getLocations($filter_type,$filter_param)
    {
        $locations = array();
        switch ($filter_type) 
        {
            case 'country':
                $locations_query = School::where('country','LIKE','%'.$filter_param.'%')
                ->distinct()
                ->get();
                if(!is_null($locations_query))
                {
                    foreach ($locations_query as $key => $loc) 
                    {
                      array_push($locations,$loc->country);
                    }
                }
                
                break;

            case 'province':
                $locations_query = School::where('province','LIKE','%'.$filter_param.'%')
                ->distinct()->get();
                if(!is_null($locations_query))
                {
                    foreach ($locations_query as $key => $loc) 
                    {
                      array_push($locations,$loc->province);
                    }
                }
                break;

            case 'town':
                $locations_query = School::where('suburb','LIKE','%'.$filter_param.'%')
                ->distinct()
                ->get();
                if(!is_null($locations_query))
                {
                    foreach ($locations_query as $key => $loc) 
                    {
                      array_push($locations,$loc->suburb);
                    }
                }
                break;
            
            default:
                $locations_query = School::whereNotNull('country')
                ->distinct()
                ->get();
                break;
        }

        return response()->json([
            'posts'=>$locations
        ]);

        
    }

    public function zlto()
    {
        $client = new Client(); 
        $data=[
                    'grant_type' => 'client_credentials',
                    'client_id' => 'zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX',//$_ENV['ZLTO_CLIENT_ID'], // get id from the env file
                    'client_secret' =>'hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v' ,//$_ENV["ZLTO_CLIENT_SECRET"], // get secret from the env file
                    'redirect_uri' => 'https://bana.vision',
                    "scope" => "partner store earn client"
                ];

        $response = $client->post('https://staging-api.zlto.co/oauth/token/', ['json'=> $data] );






            $res_data = json_decode($response->getBody(), true);
            //dd($res_data['access_token']);
            session(['access_token'=>$res_data['access_token']]);
            //dd(session('access_token'));
            $token = $res_data['access_token'];

           /* $stack = HandlerStack::create();

$middleware = new Oauth1([
    'consumer_key'    => 'zp2MKcK3DzwowhB90E9lt2IcuPY3JSuh4Dn4mbEX',
    'consumer_secret' => 'hLcqddSuigoC6T6RBB27Hh76Y8psTMPVoKWIah8lWR1cjdVk3jc2eaO1S7HeTSq36uTziQPRmkBzr7oJaNsigY33hrdyxaAQohAQa7Jd0vS2K7LSh4KMm7JNonzpom6v',
    'token'           => session('access_token'),
    //'token_secret'    => session('access_token')
]);
$stack->push($middleware);



$client_get = new Client([
    'base_uri' => 'https://staging-api.zlto.co',
    'handler' => $stack,
    'auth' => 'oauth'
]);

// Now you don't need to add the auth parameter
$res = $client_get->get('client');*/



//$response_ = $client->request('GET', 'https://staging-api.zlto.co/earn/categories');
/*$response_ = (new Client())->get('https://api.zlto.co/partner/user/email/{client_email}/', [
           'headers' => [
               'Authorization' => 'Bearer '.$token
           ]
       ]);*/

       //dd(json_decode( $response_->getBody(), true));

    }
    public function zlto_user_sign_up($token)
    {
        $client = new Client(['headers' => [
               'Authorization' => 'Bearer '.$token
           ]]); 
        $data=[
                 'name'=>'lerato lethabo',
                 'surname'=>'emma mabena',
                 'email' =>'refilweblube@gmail.com'  
              ];

        $response = $client->post('https://staging-api.zlto.co/partner/signup/', ['json'=> $data] );
        $res_data = json_decode($response->getBody(), true);
        dd($res_data['profile']['my_uuid_id']);
    }
    /********************************************************************
    * GET USER ZLTO PROFILE DETAILS
    *********************************************************************
    *Retrieve one user's profile that belongs to the partner.
    *
    *
    */
    public function zlto_get_user_profile()
    {
        $zlto_my_uuid_id = Auth::user()->usable->zlto_my_uuid_id;
        $response_ = (new Client())->get('https://staging-api.zlto.co/partner/user/'.$zlto_my_uuid_id, [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }

    /********************************************************************
    * GET BANA ZLTO USERS
    *********************************************************************
    *Retrieve one user's profile that belongs to the partner.
    *
    *
    */
    public function zlto_get_users()
    {
        $zlto_my_uuid_id = Auth::user()->usable->zlto_my_uuid_id;
        $response_ = (new Client())->get('https://api.zlto.co/partner/users/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
    /********************************************************************
    * GET ZLTO stores
    *********************************************************************
    *Retrieve one user's profile that belongs to the partner.
    *
    *
    */
    public function zlto_get_stores()
    {
        $response_ = (new Client())->get('https://api.zlto.co/client/', [
           'headers' => [
               'Authorization' => 'Bearer '.session('access_token')
           ]
       ]);

       dd(json_decode( $response_->getBody(), true));
    }
}

//Retrieve one user's profile that belongs to the partner.
//https://api.zlto.co/partner/user/{client_uuid}/

//Retrieve a list of all the users that signed up with a partner.
//https://api.zlto.co/partner/users/

https://api.zlto.co/store/stores/

