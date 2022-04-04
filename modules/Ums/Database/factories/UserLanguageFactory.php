<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\UserLanguage;

$factory->define(UserLanguage::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['German', 'Spanish', 'Japanese']),
        'description' => $faker->paragraph,
        'proficiency' => $faker->numberBetween(1, 5),
        'user_id' => $faker->numberBetween(1, 10),
    ];
});
