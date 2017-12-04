<?php

use App\Models\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'provider'       => $faker->randomElement(['google', 'vkontakte', 'github']),
        'provider_id'    => $faker->randomNumber(),
        'avatar'         => $faker->imageUrl(100, 100),
        'remember_token' => str_random(10),
    ];
});
