<?php

use Faker\Generator as Faker;

$factory->define(App\SchoolClass::class, function (Faker $faker) {
    return [
        /*'class_name' => $faker->randomElement($array = array ('a','b','c','d','e','f','g')),
		'grade' => $faker->numberBetween($min = 1, $max =12),*/
    ];
});
