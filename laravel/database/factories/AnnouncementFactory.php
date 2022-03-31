<?php

use Faker\Generator as Faker;

$factory->define(App\Announcement::class, function (Faker $faker) {
    return [
        'announcement' =>$faker->paragraphs($nb = 3, $asText = true),
        'link' => $faker->url,
        'recurring'=>true,
       'user_id'=>1,
    ];
});
