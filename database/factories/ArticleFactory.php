<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Article::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return factory(\App\Models\Category::class)->create()->id;
        },
        'user_id'     => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
        'title'       => $faker->sentence(),
        'image'       => 'http://www.veho.ru/img/photo_not_found.gif',
        'body'        => $faker->realText(2000),
    ];
});
