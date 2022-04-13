<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'title' => Str::random(30),
        'hot' => rand(0,1),
        'description' => $faker->paragraph,
        'photo' => $faker->image('public/images',640,480, null, false),
        'price' => rand(100, 99000),
        'category_id' => function () {
            return factory(App\Models\Category::class)->create()->id;
        }
    ];
});
