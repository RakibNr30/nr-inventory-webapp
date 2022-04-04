<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Setting\Entities\Seo;

$factory->define(Seo::class, function (Faker $faker) {
    return [
        'meta_title' => $faker->sentence,
		'meta_description' => $faker->paragraph,
		'meta_type' => $faker->sentence,
		'meta_tags' => $faker->sentence,
		'canonical' => $faker->sentence,
    ];
});
