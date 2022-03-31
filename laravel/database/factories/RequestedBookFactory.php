<?php

use Faker\Generator as Faker;

$factory->define(App\RequestedBook::class, function (Faker $faker) {
    return [
    	'book_identification' => $faker->swiftBicNumber,
        'date_requested' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
