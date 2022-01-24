<?php

namespace Database\Seeders\Seeders;

use App\Domain\Users\Enums\Roles;
use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UsersRepository;
use Illuminate\Database\Seeder;

/**
 * Class SuperAdminSeeder
 *
 * @package Database\Seeders\Seeders
 */
class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param UsersRepository $usersRepository
     *
     * @return void
     */
    public function run(UsersRepository $usersRepository)
    {
        $isUserExists = $usersRepository->byRole(Roles::SUPER_ADMIN->value)->getBuilder()->exists();

        if ( !$isUserExists ) {
            tap(User::factory()->superAdmin()->create(), function (User $user) {
                $user->assignRole(Roles::SUPER_ADMIN->value);
            });
        }
    }
}
