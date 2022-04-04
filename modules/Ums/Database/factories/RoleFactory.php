<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
		'description' => $faker->paragraph,
		'guard_name' => $faker->word,
    ];
});
