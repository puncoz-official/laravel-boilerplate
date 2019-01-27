<?php

use App\Data\Entities\Models\User\User;
use Illuminate\Database\Seeder;

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
        $roleNames = array_except_by_value($roleNames, 'super_admin');

        factory(User::class, rand(20, 30))->create()->each(
            function (User $user) use ($roleNames) {
                $roleName = array_random($roleNames);
                if ( $roleName ) {
                    $user->assignRole($roleName);
                }
            }
        );
    }
}
