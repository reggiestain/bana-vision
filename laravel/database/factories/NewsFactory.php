<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'article' =>$faker->paragraphs($nb = 3, $asText = true),
        'link' => $faker->url,
       'user_id'=>1,
    ];
});
