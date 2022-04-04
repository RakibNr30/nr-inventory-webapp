<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
		'phone' => $faker->phoneNumber,
		'email' => $faker->safeEmail,
		'password' => bcrypt('password'),
		'email_verified_at' => $faker->dateTime($max = 'now', $timezone = null),
		'remember_token' => null,
		'approved_at' => $faker->dateTime($max = 'now', $timezone = null),
		'approved_by' => 1,
    ];
});
