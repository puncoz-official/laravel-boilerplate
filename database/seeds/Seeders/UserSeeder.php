<?php

use App\Data\Entities\Models\User\User;
use App\Data\Repositories\User\Role\RoleRepository;
use App\Data\Repositories\User\UserRepository;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param RoleRepository $roleRepository
     *
     * @param UserRepository $userRepository
     *
     * @return void
     */
    public function run(RoleRepository $roleRepository, UserRepository $userRepository)
    {
        $roleName = config('static-data.roles_permissions.roles.super_admin');
        $role     = $roleRepository->findByName($roleName);

        if ( !$role->users()->exists() ) {
            factory(User::class, 1)->state('super_admin')->create()->each(
                function (User $user) use ($roleName) {
                    $user->assignRole($roleName);
                }
            );

            return;
        }

        $users = factory(User::class, 1)->state('super_admin')->raw();
        collect($users)->each(
            function (array $userData) use ($roleName, $userRepository) {
                /** @var User $user */
                $user = $userRepository->findByEmailOrUsername(array_get($userData, 'email'));
                $user->update($userData);
                $user->assignRole($roleName);
            }
        );
    }
}
