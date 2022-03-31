<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
	$name =$faker->unique()->firstName;
	$lastName = $faker->unique()->lastName;
	$fullName =$name.' '.$lastName;
	$email = $name.'.'.$lastName.'@example.com';
    $slug = str_slug($fullName.$faker->numberBetween($min = 25, $max = 100),'.');
    return [
        'name' => $fullName,
        'email' => $email,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'slug' => $slug,
        'status'=>1,
    ];
});
