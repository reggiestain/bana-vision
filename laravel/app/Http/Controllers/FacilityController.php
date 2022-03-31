<?php

namespace App\Http\Controllers;
use App\School;
use App\User;
use App\Image;
use App\Comment;
use App\Like;
use App\Share;
use App\Facility;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * [addFacility description]
     * @param Request $request [description]
     */
    public function addFacility(Request $request)
    {

         $validatedData = $this->validate($request,[
            'name'=>'required|max:120',
            'description'=>'required|max:1000',
            ]);

        $facility= new Facility([
            'name' => $validatedData['name'],
            'description' => $validatedData['description']
        ]);

        if(Auth::user()->usable->facilities()->save($facility))
        {

            # saves image
            $file = $request['facilities-image'];
            if($file != null)
            {
                
                foreach($file as $key=>$fl)
                {
                    $picture_type = 'facilities';
                    $image = new Image([
                        'path' => Auth::user()->slug.'/facilities/',
                        'name' =>  $fl->extension()
                    ]);
                    $facility->images()->save($image);
                    $facility->images[$key]->update(['name'=>$facility->images[$key]->id.'.'.$facility->images[$key]->name]);

                    \Imagery::setImage($fl->extension(),$fl,$picture_type,null,Auth::user(),$image->id);
                }
            }
           
            return response()->json(['message'=>"succesfully created the facility",'post'=>$fac]);

        }
    }

    public function deleteFacility($facilityIdNo)
    {
        $facility = Facility::where('id',$facilityIdNo)->first();
        $images = $facility->images;
        $comments = Comment::where('commentable_id',$facilityIdNo)->get();
        if ($facility->delete())
        {
            #use helper to delete bursary image
            \Imagery::deleteImage($images);

            $likes = Like::where('likeable_id',$facilityIdNo)->get();
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
            $facilities =$user->usable->facilities()
            ->orderBy('created_at', 'desc')
            ->paginate(9)
            ->all();

            $userIdNumber = $user;
            return response()->json(['user' => $userIdNumber,'posts1'=>array_values($facilities)]);
        }
        else
        {
            return response()->json(['message'=>"only schools have this function"]);
        }
    }
}
