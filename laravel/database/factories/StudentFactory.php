<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'birthdate'	=> $faker->date($format = 'Y-m-d', $max = 'now'),
        //'institution' => $faker->randomElement($array = array ('mh ba','b','c')),
        // institution to be set in database seed
        'sector' => $faker->randomElement($array = array ('engineering','commerce','humanitaries')),	
        'gender' => $faker->randomElement($array = array ('male','female')),	
        'grade' => $faker->numberBetween($min = 1, $max = 12),
        //'school_id' => $faker->numberBetween($min = 1, $max = 20),
    ];
});

