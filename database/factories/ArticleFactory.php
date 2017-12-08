<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'user_id'     => function () {
            return factory(User::class)->create()->id;
        },
        'title' => $faker->sentence(),
        'image' => 'http://b-smart.co.th/wp-content/uploads/2014/07/not-found-300x300.png',
        'body'  => $faker->realText(2000),
    ];
});
