<?php

use Illuminate\Database\Seeder;

use App\SchoolStudent;

use App\Setting;
use App\Teacher;
use App\Curriculumn;
use App\Helpers\Console_ProgressBar;
//require_once 'app/Helpers/Console_ProgressBar.php';

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      print "Showing an estimate for the remaining time:\n";
$bar = new Console_ProgressBar('- %fraction% [%bar%] %percent% ETA: %estimate%', '=>', '-', 78, 10);
/*for ($i = 0; $i <= 345; $i++) {
    $bar->update($i);
    usleep(40000);
}
print "\n";*/
      $i = 0;
      factory(App\School::class, 10)->create()
      ->each(function($s) use(&$bar,&$i)
      {
          $i++;
          $bar->update($i);
        $school = $s;

        
        //CREATE CURRICULUMN 
        //for each subject out of 7
     

     $count_e = 0;
                $fst_occ_e = true;   
              $school->events()->saveMany(factory(App\OurEvent::class,12)
                ->make())
              ->each(function($evnt)use(&$count_e,&$fst_occ_e)
              {
                $evnt->comments()->saveMany(factory(App\Comment::class,8)->make());
               // \Seeder::counter("making events",$count_e,$fst_occ_e);
                //\Imagery::seederSaveImages('events',null,'nightlife',320,320,$i);

              });
                //creates 7 bursaries for each school
              $count_b = 0;
              $fst_occ_b = true;
              $school->bursaries()->saveMany(factory(App\Bursary::class,7)
                ->make())
              ->each(function($bu) use(&$count_b,&$fst_occ_b)
              {
                $bu->requirements()->saveMany(factory(App\BursaryRequirement::class,5)
                ->make());
              //  \Seeder::counter("making bursaries",$count_b,$fst_occ_b);
               // \Imagery::seederSaveImages('bursary',null,'business',320,320,$bu);

              });
              

        //performs the following functions 20 times;
        $s->user()
        ->saveMany(factory(App\User::class,1)
        ->make())
        ->each(function($e) use($school)
        {
              //creates ratings and messages
              //$count_rm = 0;
              //$fst_occ_rm = true;
          /*creates error because id is non numericif(($e->id - 1) > 0) //if is not first user
              {
               \Seeder::counter("making ratings and messages",$count_rm,$fst_occ_rm);
                $school->ratings()->saveMany(factory(App\Rating::class,3)
                  ->make(['user_id'=>$e->id-1]));
                $e->messages()->saveMany(factory(App\Message::class,3)
                  ->make(['sendTo_id'=>$e->id-1]));
              }*/
                //creates 27 events for each user 
          #make post to save profile/cover image
              $count = 0;
              $count_pp = 0;
              $fst_occ_pp = true; 
              $e->posts()->saveMAny(factory(App\Post::class,2)
                ->make())
              ->each(function($pst) use(&$count_pp,&$fst_occ_pp,&$count)
              {
               // \Seeder::counter("saving profile pictures",$count_pp,$fst_occ_pp);
                //\Seeder::saveProfilePics($count,$pst);


              });
                
            });



        //creates students for school

        
     

           /* //creates 3 featured students for each school
               $students = Student::where('school_id',$s->id)->get();
               
            if ($students->count() > 0)
            {
                $s->featuredStudents()->saveMany(factory(App\FeaturedStudent::class,3)
                ->make(['student_id' => $students->random()->id]));
            }
*/
            //creates  needs overview for each school
            $count_no = 0;
            $fst_occ_no = true;
            $s->needs_overview()->save(factory(App\NeedsOverview::class)
              ->make())
            ->each(function($no) use(&$count_no,&$fst_oc_no)
            {
            //  \Seeder::counter("making needs overview",$count_no,$fst_occ_no);
              //\Imagery::seederSaveImages('needs_overview',null,'fashion',320,320,$no->school,$no);
            });
            //creates  needs Gratitude for each school
            $count_ng = 0;
            $fst_occ_n = true;
            $s->needs_gratitude()->saveMany(factory(App\NeedsGratitude::class,5)
              ->make())
            ->each(function($ng) use(&$count_ng,&$fst_occ_ng)
            {
             // \Seeder::counter("making needs gratitude",$count_ng,$fst_occ_ng);
             // \Imagery::seederSaveImages('needs_gratitude',null,'city',320,320,$ng->school,$ng);
            });
             //creates  needs for each school
            $count_nd = 0;
            $fst_occ_nd = true;
            $s->needs()->saveMany(factory(App\OurNeed::class,13)
              ->make())
            ->each(function($nd) use(&$count_nd,&$fst_occ_nd)
            {
             // \Seeder::counter("making needs",$count_nd,$fst_occ_nd);
             // \Imagery::seederSaveImages('our_need',null,'food',320,320,$nd->school,$nd);
            });
          });
  }
}
