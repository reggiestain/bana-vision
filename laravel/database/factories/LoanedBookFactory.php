<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
 
$factory->define(App\LoanedBook::class, function (Faker $faker) {
    return [
       'year' => Carbon::now()->year,
       'book_identification' => $faker->swiftBicNumber,
       'returned' => $faker->randomElement($array = array (1,0)),
    ];
});
