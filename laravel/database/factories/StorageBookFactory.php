<?php

use Faker\Generator as Faker;

$factory->define(App\StorageBook::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween($min = 1, $max =1000),
    ];
});
