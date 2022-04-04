<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\Page;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
		'slug' => $faker->slug,
		'description' => $faker->paragraph,
		'page_category_id' => $faker->numberBetween(1, 10),
    ];
});
