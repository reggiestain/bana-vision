<?php

use Faker\Generator as Faker;

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
    	'school_id'=>1,
        'name'=>$faker->randomElement($array = array ('debate team','tennis','football','rugby','audio video club','cricket')),
        'type'=>$faker->randomElement($array = array ('academic','sports')),
        'description'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
