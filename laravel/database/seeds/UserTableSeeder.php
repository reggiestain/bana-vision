<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class, 20)->create()->each(function($u) {
    		//$u->assets()->saveMany(factory(App\Assets::class,6)->make());
    		$u->usable()->save(factory(App\Student::class)->make(/*['name' => $u->id."_logo.jpg"]*/));
  		});
    }
}
