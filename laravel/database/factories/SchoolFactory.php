<?php

use Faker\Generator as Faker;

$factory->define(App\School::class, function (Faker $faker) {
    return [
        //
    	'web_url' => $faker->url,
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
    	'district' => 'none',
    	'telephone' => $faker->e164PhoneNumber,
    	'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    	'history' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    	'principal' => $faker->name,
    	'number_students' => $faker->numberBetween($min = 700, $max = 3000),
    	'number_teachers' => $faker->numberBetween($min = 10, $max = 50),
    	'k_12' => $faker->randomElement($array = array (
    		'primary',
    		'secondary',
    		'middle',
    		'high'
    	)),
    	'coeducational' => $faker->randomElement($array = array (
    		'boys only',
    		'girls only',
    		'mixed gender'
    	)),
    	'funding' => $faker->randomElement($array = array (
    		'private',
    		'public'
    	)),
    	'pass_rate' => $faker->numberBetween($min = 25, $max = 100),
    	'special_needs' => $faker->randomElement($array = array (
    		'disabled',
    		'non-disabled'
    	)),
    	'curriculumn_type' => $faker->randomElement($array = array (
    		'technical commercial',
    		'arts',
    		'sciences',
    		'commercial',
            'montessori',
            'waldorf'
    	)),
    ];
});
