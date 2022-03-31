<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'isbn_number' => $faker->isbn13,	
        'title' => $faker->randomElement($array = array (
		'English Handbook & Study Guide',
'Afrikaans Sonder Grense Afrikaans Eerste Addisionele Taal Graad 8 Leerderboek',
'Sweef en ander verhale',
'Vonk @ Verse 2',
'Afrikaans Handbook & Study Guide',
'Creative Arts Solutions for all Creative Arts Grade 8 Learners Book',
'Study & Master Economic and Management Sciences Grade 8 Learners Book',
'Headstart Life Orientation Grade 8 Learners Book',
'DC Creations Life Orientation Grade 8 Student Workbook',
'Headstart Mathematics Grade 8 Learners Book',
'Mathematics X-Factor Gr. 8',
'Oxford Successful Natural Sciences Grade 8 Learners Book ',
'DocScientia Grade 8 Textbook and Workbook',
'Data Handling & Science Process Skills (Blue Book)',
'Oxford Successful Social Sciences Grade 8 Learners Book',
'Engineering Graphics and Design Workbook for Grade 12',
'Focus Geography Grade 12 Learners Book ',
'Focus History Grade 12 Learners Book',
'Focus Life Orientation Grade 12 Learners Book ',
'Via Afrika Life Sciences Grade 12 Learners Book',
'Mind Action Series Mathematics Gr 12 Textbook',
'Mathematics Mind Action Series Gr 12 ',
'Literacy Mathematical Literacy Grade 12 Learners Book ',
'Knowledge - Antoinette Hoek', 
'Theory Book - Riana Knoblauch ',
'Solutions for all Physical Sciences Grade 12 Learners Book '
)),	
        'author' => $faker->name($gender = null),	
        'year' => Carbon::now()->year,	
        'grade' => $faker->numberBetween($min = 1, $max =12),	
        'quantity' => $faker->numberBetween($min = 1, $max = 2700),
        'description' =>$faker->paragraphs($nb = 3, $asText = true),
        'category' =>$faker->randomElement($array = array ('physical science','accounting','home economics','economics','technical drawing','mathematics','electricians work')),
    ];
});
