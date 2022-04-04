<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\MenuLink;

$factory->define(MenuLink::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
		'description' => $faker->paragraph,
		'url' => $faker->word,
		'link_type' => $faker->numberBetween(1, 5),
    ];
});
