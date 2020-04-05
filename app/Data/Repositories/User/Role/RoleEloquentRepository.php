<?php

namespace App\Data\Repositories\User\Role;

use App\Core\BaseClasses\Repository\Repository;
use App\Data\Entities\User\Role;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

/**
 * Class RoleEloquentRepository
 * @package App\Data\Repositories\User\Role
 */
class RoleEloquentRepository extends Repository implements RoleRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * @param string      $roleName
     * @param string|null $guardName
     *
     * @return Role|array
     * @throws RoleDoesNotExist
     */
    public function findByName(string $roleName, ?string $guardName = null)
    {
        $role = Role::findByName($roleName, $guardName);

        return $this->parserResult($role);
    }
}
