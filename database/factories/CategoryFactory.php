<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'  => $faker->unique()->word,
        'image' => $faker->imageUrl(150, 150),
    ];
});
