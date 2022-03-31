<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
$factory->define(App\Attendance::class, function (Faker $faker) {
    return [	
            'year' => Carbon::now()->year,
            'mon'  => $faker->randomElement($array = array (1,0)),
            'tue'  => $faker->randomElement($array = array (1,0)),
            'wed'  => $faker->randomElement($array = array (1,0)),
            'thur' => $faker->randomElement($array = array (1,0)),
            'fri'  => $faker->randomElement($array = array (1,0)),
    ];
});