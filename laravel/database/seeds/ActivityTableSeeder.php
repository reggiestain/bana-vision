<?php

use Illuminate\Database\Seeder;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Activity::class, 5)->create()->each(function ($activity) {
        	\Imagery::seederSaveImages('activities',null,'nightlife',320,320,$activity->school,$activity);
    	});
    }
}
