<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Symfony\Component\Console\Output\ConsoleOutput;

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
    $api_token = Str::random(60);

    (new ConsoleOutput())->writeln("Your API token is {$api_token}");

    return [
        'uuid'              => $faker->uuid,
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'sub'               => str_random(),
        'lockout_time'      => (int) 15, // 15 minutes to auto-lock dashboard
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'api_token'         => hash('sha256', $api_token),
        'remember_token'    => Str::random(10),
    ];
});

