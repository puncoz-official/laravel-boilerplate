<?php

namespace Database\Factories;

use App\Domain\Users\DTO\FullNameDto;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory
 *
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name'         => FullNameDto::fromString($this->faker->name()),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function superAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'full_name' => FullNameDto::fromString('Administrator'),
                'email'     => 'admin@admin.jp',
                'password'  => 'password',
            ];
        });
    }
}
