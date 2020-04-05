<?php

use App\Constants\UserRoles;
use App\Data\Entities\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

/**
 * Class UserFaker
 */
class UserFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleNames = config('static-data.roles_permissions.roles');
        $roleNames = array_except_by_value($roleNames, UserRoles::SUPER_ADMIN);

        factory(User::class, rand(20, 30))->create()->each(
            function (User $user) use ($roleNames) {
                $roleName = Arr::random($roleNames);
                if ( $roleName ) {
                    $user->assignRole($roleName);
                }
            }
        );
    }
}
