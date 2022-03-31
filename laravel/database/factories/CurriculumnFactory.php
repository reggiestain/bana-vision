<?php

use Faker\Generator as Faker;

$factory->define(App\Curriculumn::class, function (Faker $faker) {
    return [
        /*'grade' => $faker->numberBetween($min = 1, $max =12),*/
		'has_practicals' => $faker->randomElement($array = array (1,0)),
		/*'subject' => $faker->unique()->randomElement($array = array ('setswana','english','afrikaans','accounting','home economics','economics','economic management science','physical science','natural science','general science','social science','geography','history','mathematics','mathematics literacy','woodwork','electricians work','metal work','technical drawing'))*/
		'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
