<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$CHAvJIeSsMY31CP0CHOO5e7CeobuPM0D96xHDLgTOyrTXstu44tDy',
    ];
});
