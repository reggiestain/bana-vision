<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
            //'registration_number'=>$faker->,
            //'business_entity'=>$faker->,
            //'registration_country'=>$faker->,
            'registered_address_country'=>$faker->country,
            'registered_address_province'=>$faker->state,
            'registered_address_town'=>$faker->city,
            'registered_address_address'=>$faker->address,
            'registered_address_area_code'=>$faker->postcode,
            'business_place_country'=>$faker->country,
            'business_place_province'=>$faker->state,
            'business_place_town'=>$faker->city,
            'business_place_address'=>$faker->address,
            'business_place_area_code'=>$faker->postcode,
            'telephone'=>$faker->phoneNumber,
            'web_url'=>$faker->url,
            'values'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'services'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            //'sector'=>$faker->,
            'year_established'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'mission'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
