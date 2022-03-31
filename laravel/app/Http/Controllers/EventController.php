<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\OurEvent;
use App\Image;
use App\Comment;
use App\Like;
use App\Reply;
use App\StudentAward;
use App\Post;
use Event;
use App\Events\PostCommentedEvent;
use App\Helpers\Images;
use Illuminate\Http\Response;
use App\Notifications\EventLiked;
use App\Notifications\EventCommented;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{


	public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['update','store']);
    }

	/******************************************************************
	*GET THE EVENTS
	*******************************************************************
	*
	*@params object,object
	*@return json
	*/
	public function index(User $user,Request $request)
	{
		if($user->usable_type == 'App\School')
		{
			$events =$user->usable->events()
			->orderBy('created_at', 'desc')
			->paginate(5)
			->all();

			$userIdNumber = $user;
            return response()->json(['user' => $user,'posts1'=>array_values($events)]);
 		}
 		else
 		{
 			return response()->json(['message'=>"only schools have this function"]);
 		}
	}

	/*************************************************************
	* DELETE EVENT
	**************************************************************
	*
	*@params integer
	*@return redirect
	*/
	public function deleteEvent($eventIdNo)
	{
		$event = OurEvent::where('id',$eventIdNo)->first();
		$images = $event->images;
		$comments = Comment::where('commentable_id',$eventIdNo)->get();
		if ($event->delete())
		{
			#use helper to delete bursary image
			\Imagery::deleteImage($images);

			$likes = Like::where('likeable_id',$eventIdNo)->get();
			foreach($comments as $comment) //deletes each image on the database
			{
				$comment->delete();
			}

			foreach($likes as $like)
			{
				$like->delete();
			}
		}
		
		return response()->json(['message'=>"successfully deleted post"]);
	}

	/******************************************************************
	* EDIT EVENT
	*******************************************************************
	*
	*@params object
	*@return response
	*/
	public function editEvent(Request $request)
	{

			$name = $request['name'];
        $description = $request['description'];
        $venue = $request['venue'];
        $date= $request['date'];
        $timeslot = $request['timeslot'];


		   $event = OurEvent::find($request['eventId']);
		   $event->name = $name;
		   $event->description = $description;
		   $event->venue = $venue;
		   $event->date = $date;
		   $event->timeslot = $timeslot;
		   //$event->userId = Auth::user()->id;
		
		$event->update();
        
		return response()->json([
			'new_eventName'=>$name,
			'new_eventDescription'=>$description,
			'new_eventVenue'=>$venue,
			'new_eventDate'=>$date,
			'new_evetTimeslot'=>$timeslot
		],200);
	}


    /*********************************************************************
    * CREATE  EVENT
    **********************************************************************
    *
    *@params object
    *@return redirect
    */
	public function store(Request $request)
	{
         $this->validate($request,[
        	'eventName'=>'required|max:120',
        	'post'=>'required|max:1000',
        	'eventDate'=>'required|date',
        	'eventVenue'=>'required|max:120',
        	'eventTimeslotTo'=>'required|max:120',
        	'eventTimeslotFrom'=>'required|max:120'
        	]);


		$event= new OurEvent([
			'name'=>$request['eventName'],
        'description'=>$request['post'],
        'venue'=>$request['eventVenue'],
        'date'=>$request['eventDate'],
        'timeslot'=>$request['eventTimeslotFrom'].'-'.$request['eventTimeslotTo']
		]);

		/*======================================= fix this part please urgently=======================================*/
		if(Auth::user()->usable->events()->save($event))
		{
          	# saves image
			$file = $request['images'];
			if($file != null)
			{
				foreach($file as $key=>$fl)
				{
                   // dd($fl);
					$picture_type = 'events';
					$image = new Image([
						'path' => Auth::user()->slug.'/events/',
						'name' =>  $fl->extension()
					]);
					$event->images()->save($image);
					$event->images[$key]->update(['name'=>$event->images[$key]->id.'.'.$event->images[$key]->name]);

					\Imagery::setImage($fl->extension(),$fl,$picture_type,null,Auth::user(),$image->id);
				}
			}
			return response()->json(['posts1'=>$event,'message'=>"event successfully created"]);

		}
	}
	
	    public function filterEvents($filter_type,$filter_parameter)
    {
        $events = null;
        switch ($filter_type) 
        {

            case 'events_name':
                $events = OurEvent::where('name','LIKE','%'.$filter_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'user_name':
                $events = OurEvent::whereHas('user' , function($query) use ($filter_parameter) {
                    $query->where('name', 'LIKE', '%' . $filter_parameter . '%')->distinct();
                })
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'date':
                $events = OurEvent::where('date',$filter_parameter)
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'venue':
            	$events = OurEvent::where('venue','LIKE','%'.$filter_parameter.'%')
            	->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
            	break;
        



            default:
                # code...
                break;
        }
        return response()->json(['posts'=>$events]);
    }

    public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
    {
         $events = array();
        switch ($suggest_type) 
        {

            case 'events_name':
                $events_query = OurEvent::where('name','LIKE','%'.$suggest_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->limit(25)
                ->get();

                foreach ($events_query as $key => $nq)
                {
                    //iterate over the school students
                    $name = $nq->name;
                    
                    //check if the student is same as the one searched for
                    if (strpos($name, $suggest_parameter) !== false && !in_array($name, $events))
                    {
                        array_push($events, $name);
                    } 
                }
                break;

            case 'user_name':
                $events_query = OurEvent::whereHas('user' , function($query) use ($suggest_parameter) {
                    $query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();
             
                foreach ($events_query as $key => $nq)
                {
                    //iterate over the school students
                    $name = $nq->user->name;
                    
                    //check if the student is same as the one searched for
                    if (strpos($name, $suggest_parameter) !== false && !in_array($name, $events))
                    {
                        array_push($events, $name);
                    } 
                }
                break;

            case 'venue':
            	$events_query = OurEvent::where('venue','LIKE','%'.$suggest_parameter.'%')
            	->orderBy('created_at', 'desc')
                ->limit(25)
                ->get();

                foreach ($events_query as $key => $nq)
                {
                    //iterate over the school students
                    $venue = $nq->venue;
                    
                    //check if the student is same as the one searched for
                    if (strpos($venue, $suggest_parameter) !== false && !in_array($venue, $events))
                    {
                        array_push($events, $venue);
                    } 
                }
            	break;
            
            default:
                # code...
                break;
        }
        return response()->json(['posts'=>$events]);
    }

   
}