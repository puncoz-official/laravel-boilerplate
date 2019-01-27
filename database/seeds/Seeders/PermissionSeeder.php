<?php

use App\Data\Repositories\User\Permission\PermissionRepository;
use Illuminate\Database\Seeder;

/**
 * Class PermissionSeeder
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param PermissionRepository $permissionRepository
     *
     * @return void
     */
    public function run(PermissionRepository $permissionRepository)
    {
        app()['cache']->forget(config('permission.cache.key'));

        collect(config('static-data.roles_permissions.permissions'))->each(
            function (string $permission) use ($permissionRepository) {
                $permissionRepository->updateOrCreate(['name' => $permission]);
            }
        );
    }
}
