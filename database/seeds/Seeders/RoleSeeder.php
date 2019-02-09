<?php

use App\Data\Repositories\User\Role\RoleRepository;
use Illuminate\Database\Seeder;

/**
 * Class RoleSeeder
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param RoleRepository $roleRepository
     *
     * @return void
     */
    public function run(RoleRepository $roleRepository)
    {
        collect(config('static-data.roles_permissions.roles'))->each(
            function (string $roleName) use ($roleRepository) {
                /** @var \App\Data\Entities\Models\User\Role $role */
                $role = $roleRepository->updateOrCreate(['name' => $roleName]);

                $permissionsByRole = config("static-data.roles_permissions.roles_permissions.{$roleName}");
                if ( $permissionsByRole ) {
                    return $role->syncPermissions($permissionsByRole);
                }

                if ( $roleName === config('static-data.roles_permissions.roles.super_admin') ) {
                    $role->syncPermissions(config('static-data.roles_permissions.permissions'));
                }
            }
        );
    }
}
