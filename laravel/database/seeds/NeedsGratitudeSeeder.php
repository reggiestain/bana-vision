<?php

use Illuminate\Database\Seeder;

class NeedsGratitudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\NeedsGratitude::class, 25)->create();
    }
}
