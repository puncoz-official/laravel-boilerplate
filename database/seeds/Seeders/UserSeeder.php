<?php

use App\Constants\UserRoles;
use App\Data\Entities\User\User;
use App\Data\Repositories\User\Role\RoleRepository;
use App\Data\Repositories\User\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param RoleRepository $roleRepository
     * @param UserRepository $userRepository
     *
     * @return void
     */
    public function run(RoleRepository $roleRepository, UserRepository $userRepository)
    {
        $superAdminRole = UserRoles::SUPER_ADMIN;
        $roleName       = config("static-data.roles_permissions.roles.{$superAdminRole}");
        $role           = $roleRepository->findByName($roleName);

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
                $user = $userRepository->findByEmailOrUsername(Arr::get($userData, 'email'));
                $user->update($userData);
                $user->assignRole($roleName);
            }
        );
    }
}
