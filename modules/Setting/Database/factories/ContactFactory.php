<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Setting\Entities\Contact;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'email' => $faker->safeEmail,
		'phone' => $faker->phoneNumber,
		'mobile' => $faker->phoneNumber,
		'fax' => $faker->phoneNumber,
		'website' => $faker->url,
		'address' => $faker->address,
		'google_map' => $faker->url,
		'longitude' => $faker->longitude,
		'latitude' => $faker->latitude,
		'facebook' => $faker->url,
		'twitter' => $faker->url,
		'linked_in' => $faker->url,
		'youtube' => $faker->url,
		'instagram' => $faker->url,
		'skype' => $faker->url,
		'whatsapp' => $faker->url,
		'working_hours' => $faker->numberBetween(1, 10),
		'working_days' => $faker->numberBetween(1, 10),
    ];
});
