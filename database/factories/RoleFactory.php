<?php

use Faker\Generator as Faker;

$factory->define(App\Models\RoleUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(2, 30),
        'role_id' => 1, // default: user
    ];
});
