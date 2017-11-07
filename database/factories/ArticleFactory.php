<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Article::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 10),
        'user_id' => 1, // is: admin
        'title' => $faker->unique()->text,
        'image' => 'http://www.veho.ru/img/photo_not_found.gif',
        'body' => $faker->realText(3000),
    ];
});
