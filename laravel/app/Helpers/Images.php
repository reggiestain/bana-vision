<?php

namespace App\Helpers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Image;
use Faker\Factory as Faker;

class Images 
{
    public static  function getImage($requestedPic,$defaultPic,$returnPic = true)
    {
        if(Storage::disk('local')->exists($requestedPic))
        {
            $file = Storage::disk('local')->get($requestedPic);
            return $file; 
        }
        else
        {
            try 
            {
                $file = Storage::disk('local')->get($defaultPic);
                if($returnPic == true)
                {
                  return $file; 
                }  
            } 
            catch (\Exception $exception) 
            {
               logger()->error($exception);
               return "Whoops! something went wrong image not found."; 
            }  
        }
    }

    /*------------------------------------------------------------------------
    *   SET IMAGE
    *------------------------------------------------------------------------
    *
    *@param image,string,object
    *@return 
    */
    public static function setImage($extension,$file,$ftype,$sftype,$user,$post_id,$sub_user = null)
    {
          //$interactionId is n+1 number of pictures in the folder
           if ($sftype == null)
           {
              $folder = $user->slug.'/'.$ftype.'/';
              $filename = $post_id.'.'.$extension;
          //creates user storage folder if it doesnt exist
           }
           else
           {
              $folder = $user->slug.'/'.$sftype.'/'.$sub_user->id.'/'.$ftype.'/';
              $filename = $post_id.'.'.$extension;
              //creates user storage folder if it doesnt exist
           }
           
          self::createFolder($folder);

          if($file)
           {
               Storage::disk('local')->put($folder.$filename,File::get($file));   
           }
    
    }

    public static function createFolder($folder)
    {
       if (!Storage::exists(storage_path('app/'.$folder))) 
          {
            Storage::makeDirectory($folder, 0755, true);
          }
    }

    /**
     * [deletes all images in a given collection]
     * @param  [App/Collection] $images [accepts a collection of images]
     * @return [type]         [description]
     */
    public static function deleteImage($images)
    {
      foreach ($images as $key => $image) 
      {
        $path = $image->path.$image->name;
        if(Storage::disk('local')->exists($path))
        {
          Storage::delete($path);
        }
        $image->delete();
      }
      
    }
    /**
     * [seederSaveImages description]
     * @param  [type] $folder       [description]
     * @param  [type] $sfolder      [description]
     * @param  [type] $img_category [description]
     * @param  [type] $width        [description]
     * @param  [type] $height       [description]
     * @param  [type] $model        [description]
     * @param  [type] $parent       [description]
     * @return [type]               [description]
     */
    public static function seederSaveImages($folder,$sfolder,$img_category,$width,$height,$model,$parent = null)
    {
      $faker = Faker::create();
      if($model->user instanceof Collection)//if model is instance of Collection
      {

        $user_d = $model->user->first()->slug;
      }
      else
      {
        if (isset($model->user->slug))//model is instance of user
        {
          $user_d = $model->user->slug;
        }
        else
        {
          $user_d = str_slug($model->name, '.').str_slug($model->surname,'.');
        }
      }
      
      
      if($sfolder == null)
      {
        $img_path = $user_d.'/'.$folder.'/';
      }
      else
      {
        $img_path = $model->school->user->first()->slug.'/'.$sfolder.'/'.$user_d.'/'.$folder.'/';
      }
      # use helper to create folder
      self::createFolder($img_path);

      # get number of pictures in folder
      $num_pics = count(Storage::files($img_path));
      $num_pics+=1;

      # upload image 
      $image = $faker->image(Storage::disk('local')->path('').$img_path, 320, 320, $img_category, true, true, 'Faker');
      $image_name = str_replace(Storage::disk('local')->path('').$img_path, '', $image);
      
      # rename image (because faker saves the images with its naming scheme)
      Storage::move($img_path.$image_name, $img_path.$user_d.'-'.$folder.'-'.$num_pics.'.jpg');

      # make image instance and save it
      if($parent == null)//if model is instance of Collection
      {
          $image_instance = $model->images()->save(factory(Image::class)->make(['path'=>$img_path,'name'=>$user_d.'-'.$folder.'-'.$num_pics.'.jpg' ]));
          return $image_instance;
      }
      else
      {
          $image_instance = $parent->images()->save(factory(Image::class)->make(['path'=>$img_path,'name'=>$user_d.'-'.$folder.'-'.$num_pics.'.jpg' ]));
          return $image_instance;
      }
      
    }
      
}