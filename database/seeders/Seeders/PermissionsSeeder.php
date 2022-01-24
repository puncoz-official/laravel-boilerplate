<?php

namespace Database\Seeders\Seeders;

use App\Domain\Modules\Enums\Abilities;
use App\Domain\Modules\Enums\Modules;
use App\Domain\Modules\Models\Module;
use App\Domain\Modules\Repositories\ModulesRepository;
use App\Domain\Users\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

/**
 * Class PermissionsSeeder
 *
 * @package Database\Seeders\Seeders
 */
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PermissionsRepository $permissionsRepository, ModulesRepository $modulesRepository)
    {
        $modules = array_map(fn(Modules $module) => $module->value, Modules::cases());

        // delete unwanted modules and permissions (related permissions will be deleted due to on delete cascade rule)
        $modulesRepository->deleteWhereNotIn('name', $modules);

        app()['cache']->forget(config('permission.cache.key'));

        collect($modules)->each(function (string $name) use ($permissionsRepository, $modulesRepository) {
            tap(
                $modulesRepository->updateOrCreate(['name' => $name]),
                function (Module $module) use ($permissionsRepository) {
                    $abilities = Modules::getAbilitiesByName($module->name);

                    collect($abilities)->each(function (Abilities $ability) use ($permissionsRepository, $module) {
                        $permissionsRepository->updateOrCreate([
                            'module_id'  => $module->id,
                            'name'       => sprintf('%s::%s', $module->name, $ability->value),
                            'guard_name' => config('auth.defaults.guard'),
                        ]);
                    });
                }
            );
        });
    }
}
