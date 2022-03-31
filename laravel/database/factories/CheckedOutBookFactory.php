<?php

use Faker\Generator as Faker;

$factory->define(App\CheckedOutBook::class, function (Faker $faker) {
    return [
        
        'date_checked_out' => $faker->dateTime($max = 'now', $timezone = null),	
        'due_date' => $faker->dateTime($max = 'now', $timezone = null),
        'returned' => $faker->randomElement($array = array (1,0)),
    ];
});
