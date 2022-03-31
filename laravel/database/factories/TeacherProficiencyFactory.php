<?php

use Faker\Generator as Faker;

$factory->define(App\TeacherProficiency::class, function (Faker $faker) {
    return [
        'experience' => $faker->numberBetween($min = 1, $max =30),
    ];
});
