<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Comments;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user,$post_type,$post_id)
    {
    	$comments =$user->usable
    		->$post_type
    		->find($post_id)
    		->comments
            //->orderBy('created_at', 'desc')
            //->paginate(5)
            ->all();

            $userIdNumber = $user;
            return response()->json(['user' => $userIdNumber,'posts1'=>array_values($comments),'callbacks'=>['comment_post_id'=>$post_id]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$user= Auth::user();
        $comment = new Comment();
		$comment->body = $request['body'];
		$comment->user_id = Auth::user()->id;
        $commentable_type = $request['commentable_type'];

        if ($commentable_type == "App\Post")//user only has post and no other kinds
        {
        	$user->$$commentable_type->comments()->save($comment);
        }
    	else
    	{
    		$user->usable->$$commentable_type->comments()->save($comment);
    	}
        return response()->json(['comment'=>$comment]);
        switch ($request['commentable_type']) 
        {
        	case 'App\Post':
        		$post = Post::find($request['commentable_id']);
        		//$student_aOwner = User::find($event->user_id); 
        		if($post->comments()->save($comment))
        		{
        			/*$eventOwner->notify(new EventCommented($eventOwner));
        			event(new PostCommentedEvent($eventOwner,' commented on your post',$comment,"commented"));	*/
        		}
        		break;
        	case 'App\OurEvent':
        		$event = OurEvent::find($request['commentable_id']);
				$eventOwner = User::find($event->user_id); 
				if($event->comments()->save($comment))
				{
					$eventOwner->notify(new EventCommented($eventOwner));
					event(new PostCommentedEvent($eventOwner,' commented on your post',$comment,"commented"));	
				}
        		break;
            case 'App\StudentAward':
        		$student_award = StudentAward::find($request['commentable_id']);
        		//$student_aOwner = User::find($event->user_id); 
        		if($student_award->comments()->save($comment))
        		{
        			/*$eventOwner->notify(new EventCommented($eventOwner));
        			event(new PostCommentedEvent($eventOwner,' commented on your post',$comment,"commented"));	*/
        		}
        		break;
            case 'value':
        		# code...
        		break;
        	default:
        		# code...
        		break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
	/*public function getDashboard()
	{
		$posts = Post::all();
		return view('dashboard',['posts'=>$posts]);
	}

    public function getProfilePage()
	{
		$posts = Post::orderBy('created_at','desc')->get();
		return view('profilePage',['posts'=>$posts]);
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
		return redirect()->route('profilePage')->with(['message' => $message]);
	}

	public function getDeletePost($post_id)
	{
		$post = Post::where('id',$post_id)->first();
		if (Auth::user() != $post->user)
		{
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('profilePage')->with(['message'=>'successfully deleted']);
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
}