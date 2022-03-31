<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
    	'user_id'=>1,
       'subject'=>$faker->randomElement($array = array ('setswana','english','afrikaans','mathematics','physical science','biology','electricians work')),
       'read_permission'=>$faker->numberBetween($min = 0, $max = 1),
       'write_permission'=>$faker->numberBetween($min = 0, $max = 1),
       'title'=>$faker->sentence($nbWords = 6, $variableNbWords = true) ,
       'body'=>$faker->text($maxNbChars = 900) 
    ];
});
				
