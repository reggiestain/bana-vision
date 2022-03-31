<?php

use Illuminate\Database\Seeder;

class FacilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Facility::class, 5)->create()->each(function ($facility) {
        	\Imagery::seederSaveImages('facilities',null,'nightlife',320,320,$facility->school,$facility);
    	});
    }
}
