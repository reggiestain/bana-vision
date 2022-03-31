<?php
namespace App\Http\Controllers;
//use Session;
use App\Post;
use App\Like;
use App\User;
use App\Reply;
use App\OurEvent;
use App\Bursary;
use App\OurNeed;
use App\Image;
use App\Comment;
use App\Share;
use App\BursaryRequirement;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{

	/*public function getDashboard()
	{
		$posts = Post::all();
		return view('dashboard',['posts'=>$posts]);
	}

    public function getSchoolProfilePage($userIDD)
	{
		//$userID = Session::get('userIDD');
		//$searchstring = session()->get('userIDD');
		$userID = User::where('id',$userIDD)->first();
		$events = Event::where('userId',$userIDD)->paginate(25);
        $usersLikeds = Like::where('user_id',$userIDD)->where('likeable_type','App\User')->get();
        $following = new Collection;
        foreach ($usersLikeds as $usersLiked) 
        {
        	$following->push( User::where('id',$usersLiked->likeable_id)->first());
        }

        $usersLikings = Like::where('likeable_id',$userIDD)->where('likeable_type','App\User')->get();
        $followers = new Collection;
        foreach ($usersLikings as $usersLiking) 
        {
        	$followers->push( User::where('id',$usersLiking->user_id)->first());
        }
		//$bursaries = DB::table('bursariesavailable')->get();
		$comments = Comment::where('commentable_type','App\Event')->get();
		//$query_array = $request->getQueryString();
		$posts = Post::orderBy('created_at','desc')->get();
		
		//return view('SchoolSchoolProfilePage',['costs'=>$posts,'userId'=>$userID]);
		return view('SchoolProfilePage',['userIdNo' => $userID,'comments' => $comments,'events' => $events,'followings'=>$following,'followers'=>$followers]);
	}

	public function postCreatePost(Request $request)
	{
		$this->validate($request,[
			'body'=>'required|max:1000'
			]);
		$post = new Post();
		$post->body = $request['body'];
		$message = 'an error has occured';
		if($request->user()->posts()->save($post)){
			$message = 'Post successfully created!';
		}
		return redirect()->route('SchoolSchoolProfilePage')->with(['message' => $message]);
	}

	public function getDeletePost($post_id)
	{
		$post = Post::where('id',$post_id)->first();
		if (Auth::user() != $post->user)
		{
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('SchoolProfilePage')->with(['message'=>'successfully deleted']);
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

     /*
     *
     *$interacted_id is the id of the like/comment/share or even reply
     *
     *@return view
     */

	/*********************************************************************
	*	GET POST
	**********************************************************************
	*
	*
	*
	*/
	public function getPost(User $user,$interaction_type,$interacted_id)
	{
		#remember to setup an exception when the interaction isnt found!!!!!!!
		$post = null;
		switch ($interaction_type) {
			case 'commented':
				$post_interacted = Comment::find($interacted_id);
				$post = $post_interacted->commentable;
				break;
			
			case 'liked':
				$post_interacted = Like::find($interacted_id);
				$post = $post_interacted->likeable;
				break;

			case 'replied':
				# code...
				break;

			case 'shared':
				# code...
				break;

			default:
				# code...
				break;
		}
		return view('post',['post'=>$post,'userIdNo'=>$user,'key'=>0]);
	}
	/*********************************************************************
	*	CREATE REPLIES
	**********************************************************************
	*
	*
	*
	*/
	public function createReply(Request $request)
	{
		$comment = Comment::find($request['commentId']);
		$reply = new Reply();
		if(isset($request['body']) && !is_null($request['body']))
		{
	    	$reply->body = $request['body'];
		}
		else
		{
			$reply->body = '';
		}
		$reply->comment_id = $request['commentId'];
		$reply->user_id = Auth::id();
		$picture_type = 'reply';
		$file = $request['reply_picture'];
		$reply->save();
		/*$image = new Image();
            $image->path = Auth::user()->slug.Auth::id().'/reply/';
            $image->name = Auth::user()->slug.Auth::id().'-reply-'.$num_pics.'.'.$file->extension();
            $event->images()->save($image);
		if (isset($file) && !is_null($file)) 
		{
			\Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$reply->id);
		}*/
		return redirect()->back();
	}
	/*********************************************************************
	*
	**********************************************************************
	*
	*
	*
	*/
	public function getReplyPic($userId,$filename)
	{
		$user = User::find($userId);
		#uses helper to check if profile pic exists
		return new Response(\Imagery::getImage($user->slug.$user->id.'/reply/'.$filename,'avatar.jpg',false),200);
		
	}
	/*********************************************************************
	*
	**********************************************************************
	*
	*
	*
	*/
	public function createPost(Request $request)
	{
		if((is_null($request['body']) || !isset($request['body'])) && (is_null($request['addPicture']) || !isset($request['addPicture'])))
		{
			return redirect()->back()->withErrors(['message', 'cannot submit empty post']);
		}
		$user = Auth::user();
		$file = $request['addPicture'];
		$picture_type = 'post';
		$post = new Post();
		$post->user_id = $user->id;
		$post->body = $request['body'];
		if($post->save())
		{
			if($file)
			{
				if(Image::where('path',Auth::user()->slug.'/'.$picture_type.'/')->max('pic_number') != null)
            	{
            		$num_pics = Image::where('path',Auth::user()->slug.'/'.$picture_type.'/')->max('pic_number');
            		$num_pics +=1;
            	}
            	else
            	{
            		$num_pics = 1;
            	}

				\Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$num_pics);
				$image = new Image();
				$image->path = $user->slug.'/'.$picture_type.'/';
				$image->name = $user->slug.'-'.$picture_type.'-'.$num_pics.'.'.$file->extension();
				$image->pic_number = $num_pics;
				$post->images()->save($image);
			}
		}
		$post->setAttribute('images',$post->images);
		$post->setAttribute('post_type', get_class($post));
		return response()->json(['post',$post]);
	}

	/*****************************************************************************
	*	Creates post/event/bursary/need from the feed page
	******************************************************************************
	*
	*
	*/
	public function createFeedPost(Request $request)
	{
		$events_requirements = 'eventName,eventVenue,eventDate,eventTimeslotFrom,eventTimeslotTo';
		$bursary_requirements = 'bursaryTitle,bursaryClosingDate,bursaryApplicationLink,bursarySector,bursaryPositionsAvailable';
		$needs_requirements = 'needTitle,needQuantity,needCategory,needUrgency,needDueDate';

		$this->validate($request,[
			'post' => 'required',
			'eventName' => 'string|required_with_all:'
			.str_replace("eventName,","",$events_requirements)
			.',post|required_if:post_type,event',

			'eventVenue' => 'required_with_all:'
			.str_replace("eventVenue,","",$events_requirements)
			.',post|required_if:post_type,event|string',

			'eventDate' => 'required_with_all:'
			.str_replace("eventDate,","",$events_requirements)
			.',post|required_if:post_type,event|date',

			'eventTimeslotFrom' => 'required_with_all:'
			.str_replace("eventTimeslotFrom,","",$events_requirements)
			.',post|required_if:post_type,eventstring',

			'eventTimeslotTo' => 'required_with_all:'
			.str_replace("eventTimeslotTo,","",$events_requirements)
			.',post|required_if:post_type,event|string',

			'bursaryTitle' => 'required_with_all:'
			.str_replace("bursaryTitle","",$bursary_requirements)
			.'|required_if:post_type,bursary|string',

			'bursaryClosingDate' => 'required_with_all:'
			.str_replace("bursaryClosingDate","",$bursary_requirements)
			.'|required_if:post_type,bursary|date',

			'bursaryApplicationLink' => 'required_with_all:'
			.str_replace("bursaryApplicationLink","",$bursary_requirements)
			.'|required_if:post_type,bursary|string',

			'bursarySector' => 'required_with_all:'
			.str_replace("bursarySector","",$bursary_requirements)
			.'|required_if:post_type,bursary|string',

			'bursaryPositionsAvailable' => 'required_with_all:'
			.str_replace("bursaryTitle","",$bursary_requirements)
			.'|required_if:post_type,bursary|numeric',

			"bursaryRequirements"    => "required_with_all:"
			.str_replace("bursaryTitle","",$bursary_requirements)
			."|required_if:post_type,bursary|array|min:1",

    		"bursaryRequirements.*"  => "required_with_all:"
    		.str_replace("bursaryTitle","",$bursary_requirements)
    		."|required_if:post_type,bursary|string|distinct",

			'needTitle' => 'required_with_all:'
			.str_replace("needTitle","",$needs_requirements)
			.'|required_if:post_type,need|string',

			'needQuantity' => 'required_with_all:'
			.str_replace("needQuantity","",$needs_requirements)
			.'|required_if:post_type,need|numeric',

			'needCategory' => 'required_with_all:'
			.str_replace("needCategory","",$needs_requirements)
			.'|required_if:post_type,need|string',

			'needUrgency' => 'required_with_all:'
			.str_replace("needUrgency","",$needs_requirements)
			.'|required_if:post_type,need|string',

			'needDueDate' => 'required_with_all:'
			.str_replace("needDueDate","",$needs_requirements)
			.'|required_if:post_type,need|date',
		]);
		$message = '';
		$img_array = [];
		$user = Auth::user();

		$returned_post = null;
		$file_req = $request['image'];
		$num_pics_array = [];  //array indexing picture numbers
		//function to save the image in the database and folder
		$saveImage = function($pic_type,$req,&$num_pics_array,&$img_array,$post){
			# saves image
            $file = $req['image'];//get the array of images
            $picture_type = $pic_type;

            if($file != null)
            {  
            	foreach($file as $key=>$fl)
            	{
            		
            		$img = new Image();
            		$img->path = Auth::user()->slug.'/'.$picture_type.'/';
            		$img->name = $fl->extension();
            		$post->images()->save($img);
					$post->images[$key]->update(['name'=>$post->images[$key]->id.'.'.$post->images[$key]->name]);
            	
            		\Imagery::setImage($fl->extension(),$fl,$picture_type,null,Auth::user(),$img->id);
            	}
        	}
            
		};
		//save appropriate post 
		switch ($request['post_type']) 
		{
			//save post as event
			case 'event':
				$event = new OurEvent([
					'name' => $request['eventName'],
					'description' => $request['post'],
					'venue' => $request['eventVenue'],
					'date' => $request['eventDate'],
					'timeslot' => $request['eventTimeslotFrom'].'-'.$request['eventTimeslotTo']
				]);

				if($user->usable->events()->save($event))
				{
					$message = "event succesfully created";
					$saveImage('event',$request,$num_pics_array,$img_array,$event);

					$returned_post = $event;
					$returned_post->setAttribute('user',$returned_post->user);
				}
				break;
			//save post as bursary
			case 'bursary':
				$bursary = new Bursary([
					'title' => $request['bursaryTitle'],
					'closing_date' => $request['bursaryClosingDate'],
					'application_link' => $request['bursaryApplicationLink'],
					'sector' => $request['bursarySector'],
					'positions_available' => $request['bursaryPositionsAvailable'],
					'description' => $request['post']
				]);

				if($user->usable->bursary()->save($bursary))
				{
					$message = "bursary succesfully saved";
					$saveImage('bursary',$request,$num_pics_array,$img_array,$bursary);

					foreach ($request['bursaryRequirements'] as $key => $rqmnt) 
					{
						$requirement = new BursaryRequirement();
						$requirement->requirement = $rqmnt;
						$bursary->requirements()
						->save($requirement);
					}
					$returned_post = $bursary;
					$returned_post->setAttribute('requirements',$returned_post->bursary);
					$returned_post->setAttribute('user',$returned_post->user);
				}
				break;
			//save post as need
			case 'need':
				$need = new OurNeed([
					'school_id' => Auth::user()->usable_id,
					'title' => $request['needTitle'],
					'description' => $request['post'],
					'quantity' => $request['needQuantity'],
					'category' => $request['needCategory'],
					'due_date' => $request['needDueDate'],
					'urgency' => $request['needUrgency']
				]);

				if($user->usable->needs()->save($need))
				{
					$message = "need succesfully saved";
					$saveImage('our_need',$request,$num_pics_array,$img_array,$need);

					$returned_post = $need;
					//$returned_post->setAttribute('user',$returned_post->school->user);
				}
			break;
			//save post as post
			default:
				$post = new Post([
					'body' => $request['post']
				]);

				if($user->posts()->save($post))
				{
					$message = "post succesfully saved";
					$saveImage('post',$request,$num_pics_array,$img_array,$post);

					$returned_post = $post;
					$returned_post->setAttribute('user',$returned_post->user);
				}
				
		}
		$returned_post->setAttribute('post_type', get_class($returned_post));
		$returned_post->setAttribute('images',$returned_post->images);
		$returned_post->setAttribute('shared','false');

		return response()->json(['post',$returned_post]);
	}
	/*********************************************************************
	*
	**********************************************************************
	*
	*
	*
	*/
	public function getPostPic($slug,$folder,$filename,$subfolder,$category)
	{
		#uses helper to check if profile pic exists
		$res = null;
		if($subfolder  == 'null' && $category == 'null')
		{
			$res = new Response(\Imagery::getImage($slug.'/'.$folder.'/'.$filename,'avatar.jpg'),200) ;
		}
		else
		{
			$res = new Response(\Imagery::getImage($slug.'/'.$folder.'/'.$subfolder.'/'.$category.'/'.$filename,'avatar.jpg'),200);
		}
		return $res;

		
	}
	/*********************************************************************
	*	share the post
	**********************************************************************
	*
	*
	*
	*/
	public function sharePost(Request $request)
	{
		$post = $request['post'];
		$message = 'an error has occured';
		$share = new Share();
		$share->user_id = Auth::id();
		$share->shareable_id = $request['shareable_id'];
		$share->shareable_type = $request['shareable_type'];
		if($share->save())
		{
			$message = "post has been shared succesfully";
		}
		return redirect()->back()->with(['message'=>$message]);
	}

	/**************************************************************
	*
	***************************************************************
	*
	*
	*
	*/
	public function getComments($post_id,$post_type)
	{
		$type = 'App\\'.$post_type;
		$comments = Comment::where('commentable_id',$post_id)
		->where('commentable_type',$type)
		->with('user')
		->withCount('replies')
		->paginate(5);
		return response()->json([
			'comments',
			$comments
		]);
	}

	/**************************************************************
	*
	***************************************************************
	*
	*
	*
	*/
	public function getInteractionsCount($post_id,$post_type)
	{
		$type = 'App\\'.$post_type;
		$comments = Comment::where('commentable_id',$post_id)
		->where('commentable_type',$type)
		->count();
		$likes = Like::where('likeable_id',$post_id)
		->where('likeable_type',$type)
		->count();
		$shares = Share::where('shareable_id',$post_id)
		->where('shareable_type',$type)
		->count();
		return response()->json([
			'comments_count'=>$comments,
			'likes_count'=>$likes,
			'shares_count'=>$shares
		]);
	}

	/**************************************************************
	*
	***************************************************************
	*
	*
	*
	*/
	public function getReplies($comment_id)
	{
		$replies = Reply::where('comment_id',$comment_id)
		->with('user')
		->paginate(5);
		return response()->json([
			'replies',
			$replies
		]);
	}
}