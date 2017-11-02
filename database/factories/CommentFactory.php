<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'article_id' => $faker->numberBetween(1, 15),
        'user_id' => $faker->numberBetween(1, 30),
        'body' => $faker->text,
    ];
});
