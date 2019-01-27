<?php

use App\Data\Entities\Models\User\User;
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
/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(
    User::class,
    function (Faker $faker) {
        return [
            'username'          => $faker->unique()->userName,
            'email'             => $faker->unique()->safeEmail,
            'password'          => 'secret',
            'remember_token'    => str_random(10),
            'full_name'         => [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
            ],
            'first_login_at'    => $faker->boolean ? now() : null,
            'email_verified_at' => $faker->boolean ? now() : null,
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
            'password'          => 'secret',
            'full_name'         => [
                'first_name' => 'Administrator',
                'last_name'  => '',
            ],
            'first_login_at'    => null,
            'email_verified_at' => now(),
        ];
    }
);
