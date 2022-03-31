<?php

use Faker\Generator as Faker;

$factory->define(App\Staff::class, function (Faker $faker) {
    return [	
        'position' => $faker->randomElement($array = array ('clerk','mathematics teacher','biology teacher','accounting teacher','home economics teacher','cleaner','security guard')),
        'awards' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),	
    ];
});
