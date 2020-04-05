<?php

namespace App\Data\Repositories\User\Permission;

use App\Core\BaseClasses\Repository\Repository;
use App\Data\Entities\User\Permission;

/**
 * Class PermissionEloquentRepository
 * @package App\Data\Repositories\User\Permission
 */
class PermissionEloquentRepository extends Repository implements PermissionRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return Permission::class;
    }
}
