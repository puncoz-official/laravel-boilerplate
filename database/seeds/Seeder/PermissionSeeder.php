<?php

use App\Constants\AuthPermission;
use App\Data\Entities\Models\User\Permission;
use Illuminate\Database\Seeder;

/**
 * Class PermissionSeeder
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        collect(AuthPermission::ALL())->each(
            function (string $permission) {
                if ( !app(Permission::class)->where('name', $permission)->exists() ) {
                    app(Permission::class)->create(['name' => $permission]);
                }
            }
        );
    }
}
