<?php
namespace App\Http\Controllers;
use App\Helpers\Images;
use App\User;
use App\Student;
use App\School;
use App\OurEvent;
use App\Like;
use App\Comment;
use App\Image;
use App\Setting;
use App\Message;
use App\Post;
use App\Bursary;
use App\OurNeed;
use App\SchoolStudent;
use App\Rating;
use Photos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PictureUpdated;
use Webklex\IMAP\Client;


class UserController extends Controller
{

  public function __construct()
  {
        $this->middleware('auth:sanctum')->only(['update','store']);
  }
  
  public function getStudentProjectsPage()
  {

    return view('student.project.studentProjectsPage');
  }

  public function getStudentAwardsPage()
  {

    return view('student.award.studentAwardsPage');
  } 

  public function getFeaturedStudentsPage()
  {

    return view('student.featured.featuredStudentsPage');
  }

  public function getOurEventsPage()
  {

    return view('event.ourEventsPage');
  }

  public function getHelpReceivedOrGivenPage()
  {

    return view('helpReceivedOrGivenPage');
  }
  public function getInternshipPage()
  {

    return view('internshipPage');
  }

  


  /*********************************************************************
  *   FETCH MESSAGES
  **********************************************************************
  *
  *@params object
  *@return view
  */
  public function getMessages(User $user)
  {

    /*$userIdNo = $user->id;*/
    $receivedMessages = Message::join('users', 'messages.user_id', '=', 'users.id')
    ->select('users.name', 'messages.*')
    ->where('sendTo_id',$user->id)
    ->where('recipient_deleted','0')
    ->paginate(5);

    $followers = Like::where('likeable_type','App\User')
    ->where('likeable_id',$user->id)
    ->where('like','1')
    ->get();

    $contactList = new Collection;
    $parents_contacts = $user->usable_type =='App\School'?SchoolStudent::where('school_id',$user->usable_id)
    ->with('images')
    ->paginate(6):null;
    foreach ($followers as $key => $follower) 
    {
      $usr = User::where('id',$follower->user_id)
      ->first();
      $contactList->push($usr);
    }
    /*$receivedMessages = Message::where('sendTo_id',$userIdNo)->where('recipient_deleted','0')->get();
    $followings = Like::where('likeable_type','App\User')->where('user_id',$userIdNo)->get();
    $contactList = new Collection;
    $currentUser = User::where('id',$userIdNo)->first();
    foreach ($followings  as $following )
    {
      $user = User::where('id',$following ->likeable_id)->get();
      $contactList = $contactList->merge($user);  
    }
    $recipients =  new Collection;
    foreach ($receivedMessages as $receivedMessage) 
      {
        $user = User::where('id',$receivedMessage->from_id)->get();
        // = User::where('id',$sentMessage->from_id)->get();
        $recipients = $recipients->merge($user);    
      }
    $sentMessages = Message::where('user_id',$userIdNo)->get();*/
    if ($user->usable_type == 'App\School')
    {
      $oClient = new Client([
        'host'          => 'schools.bana.vision',
        'port'          => 993,
        'encryption'    => 'ssl',
        'validate_cert' => true,
        'username'      =>$user->slug.'@schools.bana.vision',
        'password'      => $user->usable->bana_email_password,
        'protocol'      => 'imap'
      ]);

      $aMessage = null;
      /* Alternative by using the Facade
        $oClient = Webklex\IMAP\Facades\Client::account('default');
      */

      //Connect to the IMAP Server
      $oClient->connect();

      //Get all Mailboxes
      /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
      $aFolder = $oClient->getFolders();

      //Loop through every Mailbox
      /** @var \Webklex\IMAP\Folder $oFolder */
      foreach($aFolder as $oFolder){
        //Get all Messages of the current Mailbox $oFolder
        /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
        $aMessage = $oFolder->messages()
        ->all()
        ->get();

        /** @var \Webklex\IMAP\Message $oMessage */
        /*foreach($aMessage as $oMessage){
        echo $oMessage->getSubject().'<br />';
        echo 'Attachments: '.$oMessage->getAttachments()
        ->count().'<br />';
        echo $oMessage->getHTMLBody(true);
        }*/
      }
    }

    return view('user.messages',[
      'messages'=>$receivedMessages,
      /*'sentMessages'=>$sentMessages,*/
      'userIdNo'=>$user/*,'recipients'=>$recipients*/,
      'contactList'=>$contactList,
      'emails' =>$aMessage,
      'parents_contacts'=>$parents_contacts
    ]);
  }


  /*********************************************************************
  *   SET MESSAGE SEEN
  **********************************************************************
  *
  *@params request
  *
  */
  public function setMessageSeen(Request $request)
  {
    $messageId = $request['messageSeenId'];
    $msg = Message::find($messageId);
    $msg->seen = 1;
    $msg->update();
  }

  /*********************************************************************
  *     CREATE MESSAGES
  **********************************************************************
  *
  *@params request
  *@return redirect
  */
  public function createMessage(Request $request)
  {
    $body = $request['body'];
    $recipients = explode(",", $request['recipient']);
    if(strpos($request['recipient'],","))
    {
      //$message->body = $body;

      foreach ($recipients as  $rcpnt)
      {
        $message = new Message();
        if($request->$rcpnt != 'null')
        {
          $cleanRcpnt = str_replace(" ", "_", $rcpnt);
          $message->sendTo_id = $request->$cleanRcpnt ;
        }
        else
        {
          $cleanRcpnt = $rcpnt;
          $message->sendTo_id = $request->$cleanRcpnt ;
        }
        $message->body = $body;


        $message->user_id = Auth::User()->id;
        $message->save();
      }
    }
    else //Message is sent via ajax
    {
      $message = new Message();
      $message->sendTo_id = $request['recipient'] ;
      $message->body = $body;
      $message->from_id = Auth::User()->id;
      $message->save();
    }

        //return view('messages',['messages'=>$messages]);
    return redirect()->back();
  }

  /*********************************************************************
  *   DELETE MESSAGES
  **********************************************************************
  *
  *@params integer
  *@return redirect
  */
  public function deleteMessages($messageId)
  {
    $message = Message::find($messageId);


    if((($message->recipient_deleted == false)&&($message->sender_deleted == false)))
    {
      if(Auth::user()->id == $message->sendTo_id ) //auth user is recipient 
      {
        $message->recipient_deleted = true;
        $message->seen = true;

      }
      else if(Auth::user()->id === $message->from_id )  //auth user is sender 
      {
        $message->sender_deleted = true;
        $message->seen = true;
      }
      $message->update();
    }

    else if((($message->recipient_deleted == false)||($message->sender_deleted == false)))
    {
      if(Auth::user()->id == $message->sendTo_id && $message->recipient_deleted == false) //auth user is recipient 
      {

        $message->delete();

      }
      else if(Auth::user()->id === $message->from_id && $message->recipient_deleted == false)  //auth user is sender 
      {

        $message->delete();
      }

    }

    else if(($message->recipient_deleted == true)&&($message->sender_deleted == true))
    {
      $message->delete();
    }
    return redirect()->back();
  }

  /*********************************************************************
  *
  **********************************************************************
  *
  *
  *
  */
  public function getSignupPage()
  {

    return view('user.signupPage');
  }

  //**********************POST SIGNIN*********************************************
  /*  
    public function postSignIn(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
            ]);
        
    
         //$query_array = head($request->query());
        if (Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]))
        {
        
            return redirect()->route('SchoolProfilePage',Auth::id())->with('userIDD','6');
            //return redirect()->route('SchoolSchoolProfilePage')->with('userIDD','6');
        }
        return redirect()->back();
      }*/

      public function getLogout()
      {
        Auth::logout();
        return redirect()->route('home');
      }

  /*********************************************************************
  *     EDIT USER INFO
  **********************************************************************
  *
  *@params request
  *@return redirect
  */
  public function userEditInfo(Request $request)
  {
    $user = Auth::user();
    $followers = Like::where('likeable_type','App\User')->where('likeable_id',Auth::id())->get();
    $password = bcrypt($request['password']);

    if(Auth::user())
    {
      //iterate through all the inputs
      foreach ($request->all() as $key => $request) 
      {
        if($key != '_token')//ommit the input containing the key
        {
          if($user->getAttribute($key)) //input value belongs to user class 
          {
            $user->$key = $request;
          }
          elseif($user->usable->getAttribute($key)) //input value belongs to polymorphic user class relationship
          {
            $user->usable->$key = $request;
          }
        }
      }
    }
    
      $user->usable->update();
      $user->update();
      return response()->json(['user'=>$user]);
  }

  /*********************************************************************
  *   DELETE USER
  **********************************************************************
  *
  *@params integer
  *@return redirect
  */
  public function deleteUser($userIdNo)
  {
    $user = User::where('id',$userIdNo)->first();
    $events = Event::where('userId',$userIdNo)->get();
    $school = School::where('id',$user->usable_id)->first();

    $user->delete();
    foreach($events as $event)
    {
            //delete associated event 
      $event->delete();
            //delete associated comment 
      $comment = Comment::where('commentable_id',$event->id);
      $comment->delete();
    }

    $school->delete();

    return redirect()->route('home');
  }

  /*********************************************************************
  *   LIKE EVENT
  **********************************************************************
  *
  *@params request
  *@return redirect
  */
  public function followUser(Request $request)
  {
    $likedUser = User::where('slug',$request['likeableId'])->first();
    $like = null;
    if($like = Like::where('user_id',Auth::id())->where('likeable_id',$likedUser->id)->where('likeable_type','App\User')->first())
    {
      $like->like = abs($like->like - 1);
      $like->update();
    }
    else
    {
      $like = new Like();
      $like->like = 1;
      $like->user_id = Auth::id();
      $likedUser->likes()->save($like);
    }
      return redirect()->back()->with(['message'=>'You are now following '.$likedUser->name]);
  }

  /*****************************************************************
  * Delete Cover/Profile Picture/Videos
  ******************************************************************
  *
  *@params request
  *@return  edirect
  */
  public function deleteFile(Request $request)
  {
    $post_id = $request['post_id'];
    $image = Image::where('imageable_type','App\Post')->where('imageable_id',$post_id)->first();
    $post = Post::find($post_id);
    $post->delete();
    Storage::delete($image->path.$image->name);
    $image->delete();
    return redirect()->back()->with(['message'=>'The file was succesfully deleted']);
  }

  /********************************************************************************
  * Get the user ratings
  *********************************************************************************
  *
  *
  *
  */
  public function getRatings(User $user)
  {
    $ratings = Rating::where('school_id',$user->usable_id)->with('user')->paginate(6);
    return response()->json(['ratings'=>$ratings->getCollection()]);
  }

  public function search(User $user,$query,$query_type,$query_field,$multiple_queries)
  {
    $query_num = $multiple_queries?:'first()';
    //$search = $user->usable->{$query_type}()->where($query_field,'LIKE',"%{$query}%");
    $search = $user->usable->students->filter(function($student) use ($query){
      return stristr($student->name,$query) !== false;
    })->toArray();

    //$search = $user->usable->{$query_type};
    return response()->json(['posts'=>$search]);
  }

  public function show(User $user)
    {
        return response()->json(['posts1'=>$user]);
    }
}