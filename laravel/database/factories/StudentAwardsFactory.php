<?php

use Faker\Generator as Faker;

$factory->define(App\StudentAward::class, function (Faker $faker) {
    return [
        'field' => $faker->randomElement($array = array ('science','maths','business','soccer','chess','debate','athletics','netball','volleyball','gymnastics')),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'year' => $faker->numberBetween($min = 2016, $max = 2018),
        'awarded_by' => $faker->company,
    ];
});
