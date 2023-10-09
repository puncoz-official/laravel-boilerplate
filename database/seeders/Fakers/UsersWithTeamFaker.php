<?php

namespace Database\Seeders\Fakers;

use App\Domain\Team\Models\Team;
use App\Domain\User\Models\User;
use App\Enums\Role;
use Database\Factories\TeamFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

/**
 * Class UsersWithTeamFaker
 */
class UsersWithTeamFaker extends Seeder
{
    public function run()
    {
        $teams = TeamFactory::new()->count(rand(2, 5))->create();

        $teams->each(function (Team $team) {
            $users = UserFactory::new()->count(rand(1, 3))->create();

            $users->each(function (User $user) use ($team) {
                $team->users()->attach($user, ['role' => Role::values()->random()]);
            });
        });
    }
}
