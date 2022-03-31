<?php

use Faker\Generator as Faker;

$factory->define(App\LibraryBook::class, function (Faker $faker) {
	$num_available = $faker->numberBetween($min = 1, $max =60);
    return [
        'format'	=> $faker->randomElement($array = array ('electronic','hardcopy')),
        'quantity'	=> $faker->numberBetween($min = 1, $max =60),	
        'reserved'	=> $faker->randomElement($array = array (0,1)),	
        'num_available'	=> $num_available,	
        'num_total' => $num_available + 8,
        'location'	=> $faker->randomElement($array = array ('shelf 1 row 1 column 2','shelf 9 row 3 column 2','shelf 11 row 1 column 26','shelf 6 row 9 column 2')),

    ];
});
