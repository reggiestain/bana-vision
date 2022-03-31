<?php

use Illuminate\Database\Seeder;
use App\Setting;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Student::class, 20)->create()->each(function($s) {
    		//$u->assets()->saveMany(factory(App\Assets::class,6)->make());
    		$s->user()->saveMany(factory(App\User::class,1)
          ->make(/*['name' => $u->id."_logo.jpg"]*/))
          ->each(function($u) // make a post to save the profile/cover images
          {
            $count = 0;
           $u->posts()->saveMAny(factory(App\Post::class,2)
              ->make())
              ->each(function($po,&$count)
                {
                  
                  if($count == 0)
                  {
                    $image = \Imagery::seederSaveImages('profile','people',320,320,$po);
                    $po->user->settings()->save(factory(App\Setting::class)->make(['profile_pic_id'=>$image->id]));
                  }
                  else
                  {
                    $image = \Imagery::seederSaveImages('cover','people',320,320,$po);
                    $set = Setting::where('user_id',$po->user->id)->first();
                    $set->cover_pic_id= $image->id;
                    $set->update();
                  }
                  
                  
                });
          });

            $s->studentAwards()->saveMany(factory(App\StudentAward::class,6)
                ->make(['school_id' => $s->school_id]))
                ->each(function($sa)
                    {
                        \Imagery::seederSaveImages('student_awards','animals',320,320,$sa->student,$sa);
                    });

            $s->studentsProjects()->saveMany(factory(App\StudentsProject::class,2)
              ->make(['school_id'=>$s->school_id]))
            ->each(function($sp,$s)
            {
              echo $sp->school;
              $image = \Imagery::seederSaveImages('students_projects','people',320,320,$sp->school,$sp);
              $sp->students()->sync([$s->id]);
            });
  		});
    }
}
