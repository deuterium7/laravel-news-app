<?php

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'  => $faker->unique()->word,
        'image' => $faker->imageUrl(150, 150),
    ];
});
