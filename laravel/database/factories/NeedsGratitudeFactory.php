<?php

use Faker\Generator as Faker;

$factory->define(App\NeedsGratitude::class, function (Faker $faker) {
    return [
        'message' => $faker->text($maxNbChars = 200),
    ];
});
