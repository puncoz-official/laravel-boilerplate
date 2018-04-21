<?php

use App\Constants\AuthPermission;
use App\Constants\AuthRoles;
use App\Data\Entities\Models\User\Role;

/**
 * Class RoleSeeder
 */
class RoleSeeder extends \Illuminate\Database\Seeder
{
    /**
     * @var array
     */
    protected $rolePermissions = [
        AuthRoles::SUPER_ADMIN => [AuthPermission::GLOBAL],
        AuthRoles::ADMIN       => [
            AuthPermission::MANAGE_USER,
            AuthPermission::MANAGE_USER__CREATE,
            AuthPermission::MANAGE_USER__READ,
            AuthPermission::MANAGE_USER__UPDATE,
            AuthPermission::MANAGE_USER__DELETE,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(AuthRoles::ALL())->each(
            function (string $role) {
                /** @var Role $roleInDb */
                $roleInDb = app(Role::class)->where('name', $role)->first();
                if ( is_null($roleInDb) ) {
                    $roleInDb = app(Role::class)->create(['name' => $role]);
                }

                $roleInDb->syncPermissions(array_get($this->rolePermissions, $role, []));
            }
        );
    }
}
