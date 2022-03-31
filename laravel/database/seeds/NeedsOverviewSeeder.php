<?php

use Illuminate\Database\Seeder;

class NeedsOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\NeedsOverview::class, 25)->create();
    }
}
