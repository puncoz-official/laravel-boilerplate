<?php

use App\Data\Entities\User\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/** @var Factory $factory */

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

$factory->define(
    User::class,
    function (Faker $faker) {
        return [
            'username'          => $faker->unique()->userName,
            'email'             => $faker->unique()->safeEmail,
            'full_name'         => [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
            ],
            'email_verified_at' => $faker->boolean ? now() : null,
            'password'          => 'secret',
            'first_login_at'    => $faker->boolean ? now() : null,
            'remember_token'    => Str::random(10),
        ];
    }
);

$factory->state(
    User::class,
    'super_admin',
    function () {
        return [
            'username'          => 'admin',
            'email'             => 'admin@admin.com',
            'password'          => 'password',
            'full_name'         => [
                'first_name' => 'Administrator',
                'last_name'  => '',
            ],
            'first_login_at'    => null,
            'email_verified_at' => now(),
        ];
    }
);
