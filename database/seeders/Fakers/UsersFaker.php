<?php

namespace Database\Seeders\Fakers;

use App\Domain\Users\Enums\Roles;
use App\Domain\Users\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

/**
 * Class UsersFaker
 *
 * @package Database\Seeders\Fakers
 */
class UsersFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new()->count(rand(25, 50))->create()->each(function (User $user) {
            $user->assignRole(Roles::USER->value);
        });;
    }
}
