<?php

namespace Database\Seeders\Seeders;

use App\Domain\Users\Enums\Roles;
use App\Domain\Users\Repositories\RolesRepository;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class RolesSeeder
 *
 * @package Database\Seeders\Seeders
 */
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(RolesRepository $repository)
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        collect(Roles::cases())->map(function (Roles $role) use ($repository) {
            $repository->updateOrCreate([
                'name' => $role->value,
            ], [
                'guard_name' => config('auth.defaults.guard'),
            ]);
        });
    }
}
