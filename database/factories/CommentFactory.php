<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'article_id' => function () {
            return factory(Article::class)->create()->id;
            // return Article::all()->random()
        },
        'user_id'    => function () {
            return factory(User::class)->create()->id;
            // return User::all()->random()
        },
        'body' => $faker->paragraph,
    ];
});
