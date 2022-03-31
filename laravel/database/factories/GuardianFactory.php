<?php

use Faker\Generator as Faker;

$factory->define(App\Guardian::class, function (Faker $faker) {
    return [
        'title' =>$faker->title($gender = null),
        'gender' =>$faker->randomElement($array = array ('male','female')),
        'surname' =>$faker->lastName,
        'name' =>$faker->firstName($gender = null),
        'contact_number' =>$faker->phoneNumber,
        'postal_address' =>$faker->address,
        'postal_code' =>$faker->postcode,
        'city' =>$faker->city,
        'street_name' =>$faker->streetName,
        'house_number' =>$faker->buildingNumber,
        'relationship_to_student' =>$faker->randomElement($array = array ('mother','father','brother','sister','uncle','aunt','grandfather','grandmother','foster parent')),
        'id_number' =>$faker->idNumber,
        'employment_status' =>$faker->randomElement($array = array ('employed','unemployed','self_employed')),
        'job_sector' =>$faker->randomElement($array = array ('retail','information technology','manufacturing','banking')),
        'company' =>$faker->company,
    ];
});
