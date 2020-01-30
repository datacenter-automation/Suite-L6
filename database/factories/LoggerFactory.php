<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Logger::class, function (Faker $faker) {
    return [
        'method'            => $faker->word,
        'controller'        => $faker->word,
        'action'            => $faker->word,
        'parameter'         => $faker->text,
        'headers'           => $faker->text,
        'origin_ip_address' => $faker->ipv4,
        'user'              => 1,
    ];
});
