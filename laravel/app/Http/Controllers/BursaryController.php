<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\User;
use App\Bursary;
use App\Image;
use App\BursaryRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class BursaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['update','store']);
    }
	/*public function getDashboard()
	{
		$posts = Post::all();
		return view('dashboard',['posts'=>$posts]);
	}

    public function getSchoolSchoolProfilePage()
	{
		$posts = Post::orderBy('created_at','desc')->get();
		return view('SchoolSchoolProfilePage',['posts'=>$posts]);
	}

*/
	/**
	 * @param  Request
	 * @return [type]
	 */
    public function getGeneralBursariesAvailablePage(Request $request)
	{
		$bursaries = Bursary::latest()->with('requirements')
        ->with('images')
        ->with('user')
        ->limit(40)
        ->orderBy('created_at', 'desc')
        ->paginate(5)
        ->setPageName('page1');
		if ($request->ajax()) 
		{
			$bursaries = Bursary::latest()->with('requirements')
            ->with('images')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5,['*'],'page1',$_GET['page1']);
            return response()->json(['posts'=>$bursaries->getCollection()]);
        }
		return view('bursary.generalBursariesAvailablePage',['bursaries'=>$bursaries->getCollection()]);
	}

	/**
	 * @param  User
	 * @param  Request
	 * @return [type]
	 */
	public function index(User $user,Request $request)
	{
		if($user->usable_type == 'App\School')
        {
            $bursaries =$user->usable->bursaries()
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->all();

            $userIdNumber = $user;
            return response()->json(['user' => $userIdNumber,'posts1'=>array_values($bursaries)]);
        }
        else
        {
            return response()->json(['message'=>"only schools have this function"]);
        }
	}
	/**********************************************************************
	*
	***********************************************************************
	*
	*@param
	*@return view (redirect)
	*/
	public function createBursary(Request $request)
	{
		$this->validate($request,[
			'title'=>'required|max:250',
			'positions_available'=>'required|numeric|min:1',
			'application_link'=>'required|url',
			'closing_date'=>'required|date',
			'description'=>'required|string|max:1000',
			'bursary_picture'=>'required|file|mimes:jpeg,bmp,png',
			"requirements"    => "required|array|min:1",
    		"requirements.*"  => "required|string|distinct"
		]);
		$bursary = new Bursary();
		$bursary->title = $request['title'];
		$requirements = $request['requirements'];
		//$bursary->location = $request['location'];
		$bursary->positions_available = $request['positions_available'];
		$bursary->application_link = $request['application_link'];
		$bursary->closing_date = $request['closing_date'];
		$bursary->description = $request['description'];
		$user = Auth::user();
		
		$message = 'an error has occured';
		if($user->usable->bursary()->save($bursary))
		{
			
			# saves each of the requirements
			foreach ($requirements as $key => $rqmnt) 
			{
				$requirement = new BursaryRequirement();
				$requirement->requirement = $rqmnt;
				$bursary->requirements()
                ->save($requirement);
				$message = 'Post successfully created!';
			}
            
			# saves image
			$file = $request['bursary_picture'];
			if($file)
			{
				$picture_type = 'bursary';

				\Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$bursary->id);
				$image = new Image();
				$image->path = Auth::user()->slug.'/bursary/';
				$image->name = $bursary->id.'.'.$file->extension();
				$bursary->images()->save($image);
			}
			
		}
		return redirect()->back()->with(['message' => $message]);
	}

	/***************************************************************
	* Delete the bursary
	****************************************************************
	*
	*@param integer
	*@return redirect
	*/
	public function deleteBursary($bursaryId)
	{

		$message = "";
		$bursary = Bursary::where('id',$bursaryId)->first();
        $images = $bursary->images;

		if($bursary->delete())
		{
			#use helper to delete bursary image
			\Imagery::deleteImage($images);
            
			$message = "bursary succesfully deleted";
		}
		return response()->json(['message'=> $message]);
	}

/*
	public function getDeletePost($post_id)
	{
		$post = Post::where('id',$post_id)->first();
		if (Auth::user() != $post->user)
		{
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('SchoolSchoolProfilePage')->with(['message'=>'successfully deleted']);
	}

	public function postEditPost(Request $request)
	{
		$this->validate($request,[
             'body'=>'required'
			]);
		$post = Post::find($request['postId']);
		if (Auth::user() != $post->user)
		{
			return redirect()->back();
		}
		$post -> body = $request['body'];
		$post->update();
		return response()->json(['new_body'=>$post->body],200);
	}

	public function postLikePost(Request $request)
	{
		$post_id = $request['postId'];
		$is_like = $request['isLike'] ==='true';
		$update = false;
		$post = Post::find($post_id);
		if(!$post){
			return null;
		}
		$user = Auth::user();
		$like = $user->likes()->where('post_id',$post_id)->first();
		if($like){
			$already_like = $like->like;
			$update = true;
			if($already_like == $is_like){
				$like->delete();
				return null;
			}
		} else {
			$like = new Like();
		}
		$like->like = $is_like;
		$like->user_id = $user->id;
		$like->post_id = $post->id;
		if($update){
			$like->update();
		} else {
			$like->save();
		}
		return null;
	}*/

	public function filterBursaries($filter_type,$filter_parameter)
    {
        $bursaries = null;
        switch ($filter_type) 
        {
            case 'sector':
                $bursaries = Bursary::where('sector','LIKE','%'.$filter_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'title':
                $bursaries = Bursary::where('title','LIKE','%'.$filter_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'school_name':
                $bursaries = Bursary::whereHas('user' , function($query) use ($filter_parameter) {
                    $query->where('name', 'LIKE', '%' . $filter_parameter . '%');
                })
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'closing_date':
                $bursaries = Bursary::where('closing_date',$filter_parameter)
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'urgency':
                $bursaries = Bursary::whereHas('requirements' , function($query) use ($filter_parameter) {
                    $query->where('requirement', 'LIKE', '%' . $filter_parameter . '%');
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

                case 'country':
                $bursaries = Bursary::where('country', 'LIKE', '%' . $filter_parameter . '%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'province':
                $bursaries = Bursary::where('province', 'LIKE', '%' . $filter_parameter . '%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'town':
                $bursaries = Bursary::where('suburb', 'LIKE', '%' . $filter_parameter . '%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'suburb':
                $bursaries = Bursary::where('suburb', 'LIKE', '%' . $filter_parameter . '%')
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
                ->withCount('comments')
                ->withCount('likes')
                ->withCount('shares')
                ->limit(25)
                ->get();
                break;

            case 'requirement':
                $bursaries = Bursary::whereHas('requirements' , function($query) use ($filter_parameter) {
                    $query->where('requirement', 'LIKE', '%' . $filter_parameter . '%')->distinct();
                })
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->with('user')
                ->with('requirements')
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
        return response()->json(['posts'=>$bursaries]);
    }

    public function getFilterAutoSuggest($suggest_type,$suggest_parameter)
    {
         $bursaries = array();
        switch ($suggest_type) 
        {

            case 'sector':
                $bursary_query = Bursary::where('sector','LIKE','%'.$suggest_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->limit(25)
                ->get();

                foreach ($bursary_query as $key => $nq)
                {
                    //iterate over the school students
                    $sector = $nq->sector;
                    
                    //check if the student is same as the one searched for
                    if (strpos($sector, $suggest_parameter) !== false && !in_array($sector, $bursaries))
                    {
                        array_push($bursaries, $sector);
                    } 
                }
                break;

            case 'title':
                $bursary_query = Bursary::where('title','LIKE','%'.$suggest_parameter.'%')
                ->orderBy('created_at', 'desc')
                ->limit(25)
                ->get();

                foreach ($bursary_query as $key => $nq)
                {
                    //iterate over the school students
                    $title = $nq->title;
                    
                    //check if the student is same as the one searched for
                    if (strpos($title, $suggest_parameter) !== false && !in_array($title, $bursaries))
                    {
                        array_push($bursaries, $title);
                    } 
                }
                break;

            case 'school_name':
                $bursary_query = Bursary::whereHas('user' , function($query) use ($suggest_parameter) {
                    $query->where('name', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
                })
                ->limit(25)
                ->orderBy('created_at', 'desc')
                ->with('user')
                ->get();

                foreach ($bursary_query as $key => $nq)
                {
                    //iterate over the school students
                    $name = $nq->user->name;
                    
                    //check if the student is same as the one searched for
                    if (strpos($name, $suggest_parameter) !== false && !in_array($name, $bursaries))
                    {
                        array_push($bursaries, $name);
                    } 
                }
                break;

            case 'requirement':
                $bursary_query = Bursary::whereHas('requirements' , function($query) use ($suggest_parameter) {
                    $query->where('requirement', 'LIKE', '%' . $suggest_parameter . '%')->distinct();
                })
                ->limit(25)
                ->with('requirements')
                ->orderBy('created_at', 'desc')
                ->get();

                foreach ($bursary_query as $key => $nq)
                {
                    //iterate over the school students
       
                    foreach ($nq->requirements as $key => $qry )
                    {
                    	$requirement = $qry->requirement;
                    	//check if the student is same as the one searched for
                    if (strpos($requirement, $suggest_parameter) !== false && !in_array($requirement, $bursaries))
                    {
                        array_push($bursaries, $requirement);
                    } 
                    }
                    
                }
                break;

            case 'country':
                $bursary_query = Bursary::where('country','LIKE','%'.$suggest_parameter.'%')
                ->distinct()->get();
                if(!is_null($bursary_query))
                {
                    foreach ($bursary_query as $key => $loc) 
                    {
                      array_push($bursaries,$loc->country);
                    }
                }
                
                break;

            case 'province':
                $bursary_query = Bursary::where('province','LIKE','%'.$suggest_parameter.'%')
                ->distinct()->get();
                if(!is_null($bursary_query))
                {
                    foreach ($bursary_query as $key => $loc) 
                    {
                      array_push($bursaries,$loc->province);
                    }
                }
                break;

            case 'town':
                $bursary_query = Bursary::where('suburb','LIKE','%'.$suggest_parameter.'%')
                ->distinct()->get();
                if(!is_null($bursary_query))
                {
                    foreach ($bursary_query as $key => $loc) 
                    {
                      array_push($bursaries,$loc->suburb);
                    }
                }
                break;
            
            default:
                # code...
                break;
        }
        return response()->json(['posts'=>$bursaries]);
    }
}