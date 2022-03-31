<?php

use Faker\Generator as Faker;

$factory->define(App\NeedsOverview::class, function (Faker $faker) {
    return [
        'caption' => $faker->text($maxNbChars = 60),
        'body' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
