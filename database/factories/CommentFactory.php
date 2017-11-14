<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'article_id' => $faker->numberBetween(1, \Illuminate\Support\Facades\Config::get('constants.ARTICLES_SEED')),
        'user_id'    => $faker->numberBetween(1, \Illuminate\Support\Facades\Config::get('constants.USERS_SEED')),
        'body'       => $faker->text,
    ];
});
