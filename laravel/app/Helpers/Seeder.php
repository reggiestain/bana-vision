<?php
namespace App\Helpers;
class Seeder
{
	/***********************************************************************
	* display counter message to the cli during seeding 
	************************************************************************
	*
	*@param string,int,bool
	*@return int
	*/
	public static function counter($message,&$count,&$first_occurence)
	{
		if($first_occurence == true)
		{
			echo "\n";
			$first_occurence = false;
		}
			
			if ($count>0)
			{
				echo "...";
			}
			else
			{
				echo $message;
			}

			$count++;
			
	}

	public static function saveProfilePics(&$count,$po)
	{
		if($count == 0)
              {
                $image = \Imagery::seederSaveImages('profile',null,'people',320,320,$po);
                if(!(\App\Setting::where('user_id',$po->user->id)->exists()))
                {
                	$po->user->settings()->save(factory(\App\Setting::class)->make(['profile_pic_id'=>$image->id]));
                }
              	
              }
              else
              {
                $image = \Imagery::seederSaveImages('cover',null,'abstract',320,320,$po);
                $set = \App\Setting::where('user_id',$po->user->id)->first();
                $set->cover_pic_id= $image->id;
                $set->update();
              }
              $count++;

	}
}