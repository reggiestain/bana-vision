<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Rating::class, function (Faker $faker) {
    return [
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
        'rating'=>$faker->randomFloat($nbMaxDecimals =1, $min = 0, $max = 5),
        'review'=>$faker->sentences($nb = 3, $asText = true) ,
    ];
});
