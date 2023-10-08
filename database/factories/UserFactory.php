<?php

namespace Database\Factories;

use App\Domain\User\Models\User;
use App\Domain\User\ValueObjects\FullName;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name'         => FullName::fromString($this->faker->name()),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->boolean ? now() : null,
            'username'          => $this->faker->unique()->userName(),
            'password'          => 'secret',
            'remember_token'    => $this->faker->boolean ? Str::random(10) : null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function superAdmin(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'full_name'         => FullName::fromString('Administrator'),
                'email'             => 'admin@admin.com',
                'username'          => 'admin',
                'password'          => 'password',
                'email_verified_at' => now(),
            ];
        })->withPersonalTeam(name: 'System');
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(callable $callback = null, string $name = ''): static
    {
        if ( !Features::hasTeamFeatures() ) {
            return $this->state([]);
        }

        return $this->has(
            TeamFactory::new()->state(fn(array $attributes, User $user) => [
                'name'          => $name ?: $user->full_name->toString().'\'s Team',
                'user_id'       => $user->id,
                'personal_team' => true,
            ])->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }
}
