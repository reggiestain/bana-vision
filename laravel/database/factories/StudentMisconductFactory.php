<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\StudentMisconduct::class, function (Faker $faker) {
    return [
            'offence'=>$faker->randomElement($array = array ('cheated on exam','bullying','stealing','disrespecting authority','not wearing uniform')),
            'date_committed'=>Carbon::now(),
            'reported_to'=>$faker->name($gender = null) ,
            'complainant'=>$faker->name($gender = null),
            'punishment'=>$faker->randomElement($array = array ('suspended','detention','expelled')),
    ];
});
