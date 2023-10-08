<?php

namespace Database\Seeders\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

/**
 * Class SuperAdminSeeder
 */
class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new()->superAdmin()->create();
    }
}
