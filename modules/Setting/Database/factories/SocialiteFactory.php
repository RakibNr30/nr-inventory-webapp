<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Setting\Entities\Socialite;

$factory->define(Socialite::class, function (Faker $faker) {
    return [
        'google_key' => $faker->sentence,
		'google_secret' => $faker->sentence,
		'facebook_key' => $faker->sentence,
		'facebook_secret' => $faker->sentence,
		'twitter_key' => $faker->sentence,
		'twitter_secret' => $faker->sentence,
    ];
});
