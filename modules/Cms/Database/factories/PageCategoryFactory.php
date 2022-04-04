<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\PageCategory;

$factory->define(PageCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
		'description' => $faker->paragraph,
    ];
});
