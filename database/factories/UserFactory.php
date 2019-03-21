<?php

use App\Entities\User;
use Illuminate\Support\Str;
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

    $name = $faker->unique()->userName;
    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt($name),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(User::class, function (Faker $faker) {

    $name = 'temenb';
    $email = 'temenb@gmail.com';
    $entity = \App\Entities\User::where('name', '=', $name)->first();
    if ($entity) {
        $name = $faker->unique()->userName;
        $email = $faker->unique()->safeEmail;
    }

    return [
        'name' => $name,
        'email' => $email,
        'email_verified_at' => now(),
        'password' => bcrypt($name),
        'remember_token' => Str::random(10),
    ];
}, 'temenb');