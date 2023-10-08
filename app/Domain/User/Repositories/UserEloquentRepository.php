<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Models\User;
use App\Infrastructure\Support\Repositories\EloquentRepository;

/**
 * Class UserEloquentRepository
 */
class UserEloquentRepository extends EloquentRepository implements UserRepository
{
    public function model(): string
    {
        return User::class;
    }
}
