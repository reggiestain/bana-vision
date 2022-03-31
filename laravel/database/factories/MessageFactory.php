<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
        'body'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'seen'=>0,
        'recipient_deleted'=>0,
        'sender_deleted'=>0,
    ];
});

