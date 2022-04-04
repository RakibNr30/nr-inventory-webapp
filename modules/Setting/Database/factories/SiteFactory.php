<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Setting\Entities\Site;

$factory->define(Site::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
		'description' => $faker->paragraph,
    ];
});
