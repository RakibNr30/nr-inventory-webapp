<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserAdditionalInfo;

$factory->define(UserAdditionalInfo::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'designation' => $faker->sentence,
		'about' => $faker->paragraph,
		'dob' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
        'gender' => $faker->randomElement([1, 2]),
        'blood_group' => $faker->randomElement(['A+', 'B+', 'AB+', 'O+', 'O-']),
		'user_id' => $faker->numberBetween(1, 10),
    ];
});
