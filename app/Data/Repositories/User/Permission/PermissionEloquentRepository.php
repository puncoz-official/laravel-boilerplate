<?php

namespace App\Data\Repositories\User\Permission;

use App\Core\BaseClasses\Repositories\Repository;
use App\Data\Entities\Models\User\Permission;

/**
 * Class PermissionEloquentRepository
 * @package App\Data\Repositories\User\Permission
 */
class PermissionEloquentRepository extends Repository implements PermissionRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }
}
