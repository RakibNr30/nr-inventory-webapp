<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserShippingInfo;

$factory->define(UserShippingInfo::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber,
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'address' => $faker->address,
		'extra_info' => $faker->streetAddress,
		'zip_code' => $faker->postcode,
		'city' => $faker->city,
		'country_code' => $faker->countryCode,
		'user_id' => $faker->numberBetween(1, 10),
    ];
});
