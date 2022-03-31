<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\SchoolStudent::class, function (Faker $faker) {
	$grade = $faker->numberBetween($min = 1, $max =12);
    return [
       'name' => $faker->name($gender = null),	
       'id_number' => $faker->idNumber,	
       'guardian' => $faker->name($gender = null),	
       'grade' => $grade,	
       'class' => $faker->randomElement($array = array ('a','b','c','d','e','f','g')),	
       'year' => Carbon::now()->year,
       'disability' => $faker->randomElement($array = array ('none','Dyslexia','Dysgraphia','Dyscalculia','Auditory processing disorder','Nonverbal learning disability','Autism spectrum disorder (ASD)','Deafness','Deaf-blindness','Orthopedic impairment','Intellectual disability')),	
       'gender' => $faker->randomElement($array = array ('male','female')),
       'special_medication' => $faker->randomElement($array = array ('inhaler','pills')),
       'previous_school' => $faker->name($gender = null),	
       'previous_grade' => $faker->randomElement($array = array ($grade - 1,$grade)),	
       'previous_school_grade' => $faker->randomElement($array = array ($grade - 1,$grade)),
       'major' => $faker->randomElement($array = array ('accounting','life sciences','electrician work','woodwork','bricklaying','computer studies')),
    ];
});
