<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\SocialSite;

$factory->define(SocialSite::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
		'icon' => $faker->word,
		'link' => $faker->word,
    ];
});
