<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

// models...
use Modules\Ums\Entities\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
		'description' => $faker->paragraph,
		'guard_name' => $faker->word,
		'module_id' => $faker->numberBetween(1, 10),
    ];
});
