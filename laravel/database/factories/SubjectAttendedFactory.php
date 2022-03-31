<?php

use Faker\Generator as Faker;

$factory->define(App\SubjectAttended::class, function (Faker $faker) {
    return [
       'day'	=> $faker->randomElement($array = array ('mon','tue','wed','thur','fri')),
       'time'=> $faker->time($format = 'H:i:s', $max = 'now')
    ];
});
