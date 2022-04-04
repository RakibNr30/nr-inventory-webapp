<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Cms\Entities\Faq;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence,
		'answer' => $faker->paragraph,
    ];
});
