<?php

use Faker\Generator as Faker;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;


$factory->define(Article::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'user_id'     => function () {
            return factory(User::class)->create()->id;
        },
        'title' => $faker->sentence(),
        'image' => 'http://www.veho.ru/img/photo_not_found.gif',
        'body'  => $faker->realText(2000),
    ];
});
