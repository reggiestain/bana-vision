<?php

use Faker\Generator as Faker;

$factory->define(App\BursaryRequirement::class, function (Faker $faker) {
    return [
        'requirement'=>$faker->randomElement($array = array ('south african citizen','between 18 and 36','not a recipient of another bursary','first year student at leading university','high aptitude for mathematics','ambitious aver achiever','from previously disadvantaged school')) ,
    ];
});
