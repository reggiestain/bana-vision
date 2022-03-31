<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Staff::class, 23)->create()->each(function($s) {
    		//$u->assets()->saveMany(factory(App\Assets::class,6)->make());
    		$s->users()->save(factory(App\User::class)->make(/*['name' => $u->id."_logo.jpg"]*/));
  		});
    }
}
