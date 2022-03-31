<?php

use Faker\Generator as Faker;

$factory->define(App\FeaturedStudent::class, function (Faker $faker) {
    return [
        'achievements' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
