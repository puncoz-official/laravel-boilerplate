<?php

namespace Database\Seeders;

use Database\Seeders\Fakers\UsersFaker;
use Database\Seeders\Seeders\PermissionsSeeder;
use Database\Seeders\Seeders\RolesSeeder;
use Database\Seeders\Seeders\SuperAdminSeeder;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    protected array $seeders = [
        PermissionsSeeder::class,
        RolesSeeder::class,
        SuperAdminSeeder::class,
    ];

    protected array $fakers = [
        UsersFaker::class,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seeders);

        // Fakers
        if ( app()->environment() === 'production' ) {
            return;
        }

        $confirmation = $this->command->confirm(
            'Do you wish to run fakers? Fakers create dummy data for test purpose.'
        );
        if ( $confirmation ) {
            $this->call($this->fakers);
        }
    }
}
