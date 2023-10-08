<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Seeders\SuperAdminSeeder;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    protected array $seeders = [
        SuperAdminSeeder::class,
    ];

    protected array $fakers = [];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call($this->seeders);

        if ( $this->command->confirm(
            'Would you like to generate fake data? Fake data is used for testing and demonstration purposes.'
        ) ) {
            $this->call($this->fakers);
        }
    }
}
