<?php

use Faker\Generator as Faker;
use App\Models\Comment;
use App\Models\Article;
use App\Models\User;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'article_id' => function () {
            return factory(Article::class)->create()->id;
        },
        'user_id'    => function () {
            return factory(User::class)->create()->id;
        },
        'body'       => $faker->paragraph,
    ];
});
