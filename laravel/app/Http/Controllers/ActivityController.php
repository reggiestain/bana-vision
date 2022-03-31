<?php

namespace App\Http\Controllers;
use App\School;
use App\User;
use App\Image;
use App\Comment;
use App\Like;
use App\Share;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    #checking hooks again my brother
    /**
     * [addActivity description]
     * @param Request $request [description]
     */
    public function addActivity(Request $request)
    {
         $validatedData = $this->validate($request,[
            'name'=>'required|max:120',
            'description'=>'required|max:1000',
            'type'=>'required|max:120',
            ]);

        $school = Auth::user()->usable;


        $activity= new Activity([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'type' => $validatedData['type'],
        ]);

        if($school->activities()->save($activity))
        {

            # saves image
            $file = $request['activities-image'];
            if($file != null)
            {
                
                foreach($file as $key=>$fl)
                {
                    $picture_type = 'activities';
                    $image = new Image([
                        'path' => Auth::user()->slug.'/activities/',
                        'name' =>  $fl->extension()
                    ]);
                    $activity->images()->save($image);
                    $activity->images[$key]->update(['name'=>$activity->images[$key]->id.'.'.$activity->images[$key]->name]);

                    \Imagery::setImage($fl->extension(),$fl,$picture_type,null,Auth::user(),$image->id);
                }
            }
            return response()->json(['message'=>"succesfully created the activity",'post'=>$activity]);

        }
    }

    public function deleteActivity($activityIdNo)
    {
        $activity = Activity::where('id',$activityIdNo)->first();
        $images = $activity->images;
        $comments = Comment::where('commentable_id',$activityIdNo)->get();
        if ($activity->delete())
        {
            #use helper to delete bursary image
            \Imagery::deleteImage($images);

            $likes = Like::where('likeable_id',$activityIdNo)->get();
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

     public function index(User $user)
    {
        if($user->usable_type == 'App\School')
        {
            $activities =$user->usable->activities()
            ->orderBy('created_at', 'desc')
            ->paginate(9)
            ->all();

            $userIdNumber = $user;
            return response()->json(['user' => $userIdNumber,'posts1'=>array_values($activities)]);
        }
        else
        {
            return response()->json(['message'=>"only schools have this function"]);
        }
    }
}
