<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Models\Role;
use App\Infrastructure\Support\Repositories\Repository;

/**
 * Class RolesEloquentRepository
 *
 * @package App\Domain\Users\Repositories
 */
class RolesEloquentRepository extends Repository implements RolesRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Role::class;
    }
}
