<?php

use Faker\Generator as Faker;

$factory->define(App\Facility::class, function (Faker $faker) {
    return [
    	'school_id'=>1,
        'name'=>$faker->randomElement($array = array ('library','tennis court','football field','rugby field','computer lab','science lab','workshops')),
        'type'=>$faker->randomElement($array = array ('academic','sports')),
        'description'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
