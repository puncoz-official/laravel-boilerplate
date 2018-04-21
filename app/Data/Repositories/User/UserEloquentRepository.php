<?php

namespace App\Data\Repositories\User;

use App\Data\Entities\Models\User\User;
use App\StartUp\BaseClasses\Repository\BaseRepository;

/**
 * Class UserEloquentRepository
 * @package App\Data\Repositories\User
 */
class UserEloquentRepository extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
