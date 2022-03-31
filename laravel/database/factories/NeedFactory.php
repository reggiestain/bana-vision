<?php

use Faker\Generator as Faker;

$factory->define(App\OurNeed::class, function (Faker $faker) {
    return [
    
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
		'quantity' => $faker->numberBetween($min = 100, $max = 3000),
		'category' => $faker->randomElement($array = array ('financial','building materials','stationery','furniture','toiletry','food','human resource')),
		'due_date' => $faker->date($format = 'Y-m-d', $max = '2025'),
		'urgency' => $faker->randomElement($array = array ('very urgent','urgent','not urgent')),
    ];
});
