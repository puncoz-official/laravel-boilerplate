<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeders
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        // Fakers
        $confirmation = $this->command->confirm('Do you wish to run fakers? Fakers create dummy data for test purpose.');
        if ( $confirmation ) {
            $this->call(UserFaker::class);
        }
    }
}
