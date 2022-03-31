<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' =>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'user_id'=>'yjkjhkjhu89889',
    ];
});
