<?php

use App\Constants\AuthRoles;
use App\Data\Entities\Models\User\User;
use Illuminate\Database\Seeder;

/**
 * Class UserFaker
 */
class UserFaker extends Seeder
{
    /**
     * @var array
     */
    private $userRoles = [
        AuthRoles::ADMIN,
        AuthRoles::GENERAL,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 30)->create()->each(
            function (User $user) {
                $user->assignRole(array_random($this->userRoles));
            }
        );
    }
}
