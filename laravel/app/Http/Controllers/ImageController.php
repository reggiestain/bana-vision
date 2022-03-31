<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($filename);
    $path='';
    $name='';
    if($settings = $user->settings)
    {
      if($settings->cover_pic_id)
      {
        $post = $user->posts->where('images.0._id',$user->settings->cover_pic_id)->first();
        $path = $post->images->first()->path;
        $name = $post->images->first()->name;
      }
    }

    $img = Photos::make(\Imagery::getImage($path.$name,'school_cover_avatar.png'));
    $img->sharpen(15);
    return $img->text('The quick brown fox jumps over the lazy dog', 0, 0, function($font) {
      $font->file(1);
      $font->size(24);
      $font->color('#000000');
    })->response('jpg');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


      /*********************************************************************
  * GETS USER PROFILE PICTURE
  **********************************************************************
  *
  *@params integer
  *@return response
  */
  public function getProfilePic($filename)
  {
    $user = User::find($filename);
    $path='';
    $name='';

    if($settings = $user->settings)
    {
      if($settings->profile_pic_id)
      {
        $post = $user->posts->where('images.0._id',$user->settings->profile_pic_id)->first();
        $path = $post->images->first()->path;
        $name = $post->images->first()->name;
      }
      
    }

    #uses helper to check if profile pic exists
    return new Response(\Imagery::getImage($path.$name,'school_avatar.png'),200); 
  }

  /*********************************************************************
  * GETS USER COVER PICTURE
  **********************************************************************
  *
  *@params integer
  *@return response
  */
  public function getCoverPic($filename)
  {
    $user = User::find($filename);
    $path='';
    $name='';
    if($settings = $user->settings)
    {
      if($settings->cover_pic_id)
      {
        $post = $user->posts->where('images.0._id',$user->settings->cover_pic_id)->first();
        $path = $post->images->first()->path;
        $name = $post->images->first()->name;
      }
    }

    $img = Photos::make(\Imagery::getImage($path.$name,'school_cover_avatar.png'));
    $img->sharpen(15);
    return $img->text('The quick brown fox jumps over the lazy dog', 0, 0, function($font) {
      $font->file(1);
      $font->size(24);
      $font->color('#000000');
    })->response('jpg');
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
    
  /**************************************************************************************
  *  Uploads an image $ sets it as profile/cover
  ***************************************************************************************
  *
  *@param  Request
  *@return view //redirects back
  */
  public function setImage(Request $request)//you must abstract this method because it is used in many places
  {
    $filename="";
    $picture_type = $request['picture_type'];
    $file = $request->file('image');
    $user = Auth::user();

    $post = new Post();
    $post->user_id = Auth::id();
    $user->posts()->save($post);
           #upload the image as a post 

    if(Image::where('path',Auth::user()->slug.'/'.$picture_type.'/')->max('pic_number') != null)
    {
      $num_pics = Image::where('path',Auth::user()->slug.'/'.$picture_type.'/')->max('pic_number');
      $num_pics +=1;
    }
    else
    {
      $num_pics = 1;
    }

    $image = new Image();
    $image->path = $user->slug.'/'.$picture_type.'/';
    $image->name = $post->id.'.'.$file->extension();
    $image->pic_number = $num_pics; 
    $post->images()->save($image);

           #set profile/cover pic on settings
/********8*******MUST FIX SAVE METHOD TO UPDATE************************************/
    switch ($picture_type) 
    {
      case 'cover':
      $setting = $user->settings();
      $setting->save(new Setting(['cover_pic_id' => $image->id]));
      //for making the cover picture refresh
      $img = '../cover-picture/'.$user->id.'/'.rand(0,678);
      break;

      case 'profile':
      $setting = $user->settings();
      $setting->save(new Setting(['profile_pic_id' => $image->id]));
      //for making the cover picture refresh
      $img = '../profile-picture/'.$user->id.'/'.rand(0,678);
      break;

      default:
                # code...
      break;
    }

    # use helper to store the image 
    \Imagery::setImage($file->extension(),$file,$picture_type,null,Auth::user(),$post->id,$num_pics);
    $post->setAttribute('images',$post->images);
    $post->setAttribute('post_type', get_class($post));
    return response()->json(['post'=>$post,'img'=>$img]);  
  }

}
