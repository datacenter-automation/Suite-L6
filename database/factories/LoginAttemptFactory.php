<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\LoginAttempt::class, function (Faker $faker) {
    return [
        'email' => $faker->safeEmail,
        'token' => $faker->word,
    ];
});
