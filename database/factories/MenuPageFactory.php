<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Website\MenuPage::class, function (Faker $faker) {
    return [
        'text'    => $faker->word,
        'route'   => $faker->word,
        'url'     => $faker->url,
        'target'  => $faker->word,
        'icon'    => $faker->word,
        'can'     => $faker->word,
        'isTitle' => $faker->boolean,
    ];
});
