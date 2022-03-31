<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Post;
use App\User;
use FFMpeg;
use Illuminate\Support\Facades\Auth;	
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /*******************************************************
    *
    ********************************************************
    *
    *
    */
    public function saveVideo(Request $request)
    {

    	$this->validate($request,[
    		'video_type' => 'required|string', 
    		'body'=>'string',
    		'video' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,video/webm'
    	]);

    	$user = Auth::user();
    	$post = new Post();
    	$post->body = $request['body'];
    	$post->user_id = $user->id;
    	$post->save();


    	$video_type = $request['video_type'];
    	$file = $request->file('video');
        
    	$num_pics = count(Storage::files($user->slug.$user->id.'/'.$video_type.'/'));
        $num_pics+=1;
        $num_vids = count(Storage::files($user->slug.$user->id.'/'.$video_type.'/'));
        $num_vids+=1;
        //save the video
        \Imagery::setImage($file->extension(),$file,$video_type,null,Auth::user(),$num_pics);
    	$video = new Video();
    	$video->path = $user->slug.$user->id.'/'.$video_type.'/';
        $video->name = $user->slug.$user->id.'-'.$video_type.'-'.$num_pics.'.'.$request->file('video')->extension();
        $video->thumbnail_name = $user->slug.$user->id.'-'.$video_type.'-thumbnail-'.$num_pics.'.jpg';
    	$post->videos()->save($video);


    	$ffmpeg = FFMpeg\FFMpeg::create([
       'ffmpeg.binaries'  => 'C:/FFmpeg/bin/ffmpeg.exe', // the path to the FFMpeg binary
        'ffprobe.binaries' => 'C:/FFmpeg/bin/ffprobe.exe', // the path to the FFProbe binary
        'timeout'          => 3600, // the timeout for the underlying process
        'ffmpeg.threads'   => 12,   // the number of threads that FFMpeg should use
    ]);
    	$video_ = $ffmpeg->open(storage_path().'/app/'.$video->path.$video->name);
    	$video_
    	->filters()
    	->resize(new FFMpeg\Coordinate\Dimension(256, 256))
    	->synchronize();
    	$video_
    	->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
    	->save(storage_path().'/app/'.$video->path.$user->slug.$user->id.'-'.$video_type.'-thumbnail-'.$num_pics.'.jpg');
/*$video
    //->save(new FFMpeg\Format\Video\X264(), 'export-x264.mp4')
   // ->save(new FFMpeg\Format\Video\WMV(), 'export-wmv.wmv')
->save(new FFMpeg\Format\Video\WebM(), 'export-webm.webm'); */
    	return redirect()->back()->with(['message'=>'your video is still being processed']);
    }

    /********************************************************************
    *
    *********************************************************************
    *
    *
    */
    public function getVideo($video_id)
    {
        if($video = Video::find($video_id))
        {
          $path = $video->path;
          $name = $video->name;
        }
        else
        {
          $path='';
          $name='';
        }
        
        #uses helper to check if profile pic exists
        return new Response(\Imagery::getImage($path.$name,null),200);
    }
}

