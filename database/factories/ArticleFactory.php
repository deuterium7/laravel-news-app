<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Article::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1, \Illuminate\Support\Facades\Config::get('constants.CATEGORIES_SEED')),
        'user_id'     => 1, // is: admin
        'title'       => $faker->text(255),
        'image'       => 'http://www.veho.ru/img/photo_not_found.gif',
        'body'        => $faker->realText(2000),
    ];
});
