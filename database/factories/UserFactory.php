<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$t.O51FG01hpJUaWPF/e3aeQU8/fPPtoFWQl28ISm3MP26/L3PPeyG', // password
        // 'remember_token' => Str::random(10),
    ];
});
