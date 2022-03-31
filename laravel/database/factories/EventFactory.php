<?php

use Faker\Generator as Faker;

$factory->define(App\OurEvent::class, function (Faker $faker) {
    return [
        //
       // userId to be filled in SchoolTbleSeeder	
        'name'	=>$faker->randomElement($array = array ('fundraising','beauty contest','trip to zoo','provincial athleticts','debate finals','science fare')) ,
        'description' =>$faker->sentence($nbWords = 6, $variableNbWords = true),	
        'venue' =>$faker->address,	
        'date' =>$faker->date($format = 'Y-m-d', $max = 'now'),	
        'timeslot' =>$faker->randomElement($array = array ('8-11','9-5','6-2')),
    ];
});
