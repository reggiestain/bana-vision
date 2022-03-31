<?php

use Faker\Generator as Faker;

$factory->define(App\StudentsProject::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'description'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'category'=>$faker->randomElement($array = array ('science and technology','arts and culture','human social science','economic management sciences')),
        'date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
