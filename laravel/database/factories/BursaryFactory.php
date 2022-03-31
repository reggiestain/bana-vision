<?php

use Faker\Generator as Faker;

$factory->define(App\Bursary::class, function (Faker $faker) {
    return [
        // userId to be filled in Seeder
        'title'	=>$faker->randomElement($array = array ('engineering bursary','arts academy acting scholarship','fundza teaching bursary','wozniak computer science bursary','csir young scientist bursary','safa soccer scholarship')),
        'closing_date'	=>$faker->dateTime($max = 'now', $timezone = null),
        'application_link'	=>$faker->url,
        'sector'	=>$faker->randomElement($array = array ('engineering','teaching','humanities','information technology','science','commerce')),
        'positions_available'	=>$faker->numberBetween($min = 3, $max = 200),
        'description'	=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'address' => $faker->address,
    	'country' => $faker->country,
    	'suburb' => 'suburb',
    	'province' => $faker->randomElement($array = array (
    		'gauteng',
    		'free state',
    		'kwa zulu natal',
    		'mpumalanga',
    		'north west',
    		'Northen Cape',
    		'Western Cape',
    		'limpopo',
    		'Eastern Cape')),
    	'area_code' => $faker->postcode,
    ];
});
