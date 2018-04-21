<?php

use App\Constants\AuthRoles;
use App\Data\Entities\Models\User\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->states('super_admin')->create()->each(
            function (User $user) {
                $user->assignRole(AuthRoles::SUPER_ADMIN);
            }
        );
    }
}
