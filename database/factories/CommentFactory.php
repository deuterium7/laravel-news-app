<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'article_id' => $faker->numberBetween(1, 150),
        'user_id'    => $faker->numberBetween(1, 300),
        'body'       => $faker->text,
    ];
});
