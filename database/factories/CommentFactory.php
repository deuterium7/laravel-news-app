<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'article_id' => $faker->numberBetween(1, 150000),
        'user_id'    => $faker->numberBetween(1, 300000),
        'body'       => $faker->text,
    ];
});
