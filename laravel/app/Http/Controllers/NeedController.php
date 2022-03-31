<?php
namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\School;
use App\OurNeed;
use App\Comment;
use App\Like;
use App\Image;
use App\NeedsOverview;
use App\NeedsGratitude;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['update','store']);
    }
    //GET THE SCHOOLPAGE

    /**
     * [getGeneralNeedsPage description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
	public function getGeneralNeedsPage(Request $request)
	{
		$needs = OurNeed::latest()
        ->limit(40)
        ->orderBy('created_at', 'desc')
        ->with('school.user')
        ->with('images')
        ->withCount('comments')
        ->withCount('likes')
        ->withCount('shares')
        ->paginate(5)
        ->setPageName('page1');
        //the request is from ajax loading more data
        if ($request->ajax()) 
        {
            $needs = OurNeed::latest()
            ->orderBy('created_at', 'desc')
            ->with('school.user')
            ->with('images')
            ->withCount('comments')
            ->withCount('likes')
            ->withCount('shares')
            ->paginate(5,['*'],'page1',$_GET['page1'])
            ->getCollection();
            return response()->json(['posts'=>$needs]);
        }
        return view('need.generalNeedsPage',['posts'=>$needs->getCollection()]);
	}

	public function index(User $user,Request $request)
	{

        if($user->usable_type == 'App\School')
        {
            $needs =$user->usable->needs()
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->all();

            $userIdNumber = $user;
            return response()->json(['user' => $userIdNumber,'posts1'=>array_values($needs)]);
        }
        else
        {
            return response()->json(['message'=>"only schools have this function"]);
        }
	}
     
    public function createNeed(Request $request)
    {
    	$this->validate($request,[
        	'description'=>'required|max:420',
        	'title'=>'required|max:120',
        	'quantity'    => 'required|numeric',
            'category'  => 'required|string|max:120',
            'due_date'    => 'required|date',
            'urgency' =>'required|string'
        	
        	]);

        $need = new OurNeed();
        foreach ($request->all() as $key => $req) 
        {
          $need->$key = $req;
        }
        Auth::user()->usable->needs()->save($need);

        # saves image
            $file = $request['image'];
            if($file)
            {
                $picture_type = 'our_need';
                \Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$need->id);
                $image = new Image([
                    'path' => Auth::user()->slug.'/our_need/',
                    'name' => $need->id.'.'.$file->extension(),
                ]);

                $need->images()->save($image);
            }
        
    	return response()->json(['need'=>$need]);
    }

    /**
     * [createNeedsGratitude description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createNeedsGratitude(Request $request)
    {
        $this->validate($request,[
            'message'=>'required|string',
        ]);

        $needs_gratitude = new NeedsGratitude([
            'message' => $request['message']
        ]);

        $school = Auth::user()->usable;

        if ($school->needsGratitude()->save($needs_gratitude))
        {
                # saves image
            $file = $request['image'];
            $picture_type = 'needs_gratitude';

            \Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$needs_gratitude->id);
            $image = new Image([
                'path' => Auth::user()->slug.'/needs_gratitude/',
                'name' => $needs_gratitude->id.'.'.$file->extension()
            ]);

            $needs_gratitude->images()
            ->save($image);

            return response()->json(['needs_gratitude'=>$needs_gratitude]);
        }
        
    }

    /**
     * [createNeedsOverview description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createNeedsOverview(Request $request)
    {
        $this->validate($request,[
            'caption'=>'required|string|max:120',
            'overview_body'=>'required|string|max:480',
        ]);

        $no = new NeedsOverview([
                'caption'=>$request['caption'],
                'body'=>$request['overview_body'],
            ]);
        
        $needs_overview = Auth::user()->usable->needsOverview()->save($no);
    
        if(isset($request['image']) && $needs_overview->save())
        {
            # saves image
            $file = $request['image'];
            $picture_type = 'needs_overview';
           
            \Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$needs_overview->id);
            $image = new Image([
                'path' => Auth::user()->slug.'/needs_overview/',
                'name' => $needs_overview->id.'.'.$file->extension(),
            ]);

            $needs_overview->images()->save($image);
          return response()->json(['needs_overview'=>$needs_overview]);  
        } 
    }

    /**
     * [deleteEvent description]
     * @param  [type] $eventIdNo [description]
     * @return [type]            [description]
     */
    public function deleteNeed($needIdNo)
    {
        $need = OurNeed::where('id',$needIdNo)->first();
        $images = $need->images;
        $comments = Comment::where('commentable_id',$needIdNo)->get();
        if ($need->delete())
        {
            #use helper to delete bursary image
            \Imagery::deleteImage($images);

            $likes = Like::where('likeable_id',$needIdNo)->get();
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

    /**
     * [filterNeeds description]
     * @param  [type] $filter_type      [description]
     * @param  [type] $filter_parameter [description]
     * @return [type]                   [description]
     */
    public function filterNeeds($filter_type,$filter_parameter)
    {
        $needs = null;
        switch ($filter_type) 
        {
            case 'category':
                $needs = OurNeed::where('category','LIKE','%'.$filter_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('school.user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'needs_name':
                $needs = OurNeed::where('title','LIKE','%'.$filter_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('school.user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'school_name':
                $needs = OurNeed::whereHas('school.user' , function($query) use ($filter_parameter) {
                    $query->where('name', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('school.user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'date':
                $needs = OurNeed::where('due_date','LIKE','%'.$filter_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('school.user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'urgency':
                $needs = OurNeed::where('urgency',$filter_parameter)
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('school.user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

                case 'country':
                $needs = OurNeed::whereHas('school' , function($query) use ($filter_parameter) {
                    $query->where('country', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('school.user')
                ->with('images')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->get();
                break;

            case 'province':
                $needs = OurNeed::whereHas('school' , function($query) use ($filter_parameter) {
                    $query->where('province', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('school.user')
                ->with('images')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->get();
                break;

            case 'town':
                $needs = OurNeed::whereHas('school' , function($query) use ($filter_parameter) {
                    $query->where('town', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('school.user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->get();
                break;

            case 'suburb':
                $needs = OurNeed::whereHas('school' , function($query) use ($filter_parameter) {
                    $query->where('suburb', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('school.user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->get();
                break;

            default:
                # code...
                break;
        }
        return response()->json(['posts'=>$needs]);
    }

    public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
    {
         $needs = array();
        switch ($suggest_type) 
        {

            case 'category':
                $needs_query = OurNeed::where('category','LIKE','%'.$suggest_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->limit(25)
                ->get();

                foreach ($needs_query as $key => $nq)
                {
                    //iterate over the school students
                    $category = $nq->category;
                    
                    //check if the student is same as the one searched for
                    if (strpos($category, $suggest_parameter) !== false && !in_array($category, $needs))
                    {
                        array_push($needs, $category);
                    } 
                }
                break;

            case 'needs_name':
                $needs_query = OurNeed::where('title','LIKE','%'.$suggest_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->limit(25)
                ->get();

                foreach ($needs_query as $key => $nq)
                {
                    //iterate over the school students
                    $title = $nq->title;
                    
                    //check if the student is same as the one searched for
                    if (strpos($title, $suggest_parameter) !== false && !in_array($title, $needs))
                    {
                        array_push($needs, $title);
                    } 
                }
                break;

            case 'school_name':
                $needs_query = OurNeed::whereHas('school.user' , function($query) use ($suggest_parameter) {
                    $query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
                })
                ->limit(25)
                ->with('school.user')
                ->orderBy('created_at', 'desc')
                ->get();

                foreach ($needs_query as $key => $nq)
                {
                    //iterate over the school students
                    $name = $nq->school->user->first()->name;
                    //check if the student is same as the one searched for
                    if (strpos($name, $suggest_parameter) !== false && !in_array($name, $needs))
                    {
                        array_push($needs, $name);
                    } 
                }
                break;
            
            default:
                # code...
                break;
        }
        return response()->json(['posts'=>$needs]);
    }
   
}