<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Models\Permission;
use App\Infrastructure\Support\Repositories\Repository;

/**
 * Class PermissionsEloquentRepository
 *
 * @package App\Domain\Users\Repositories
 */
class PermissionsEloquentRepository extends Repository implements PermissionsRepository
{
    public function model(): string
    {
        return Permission::class;
    }
}
