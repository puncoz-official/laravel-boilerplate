<?php

namespace App\Data\Repositories\User\Role;

use App\Core\BaseClasses\Repositories\RepositoryInterface;
use App\Data\Entities\Models\User\Role;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

/**
 * Interface RoleRepository
 * @package App\Data\Repositories\User\Role
 */
interface RoleRepository extends RepositoryInterface
{
    /**
     * @param string      $roleName
     * @param string|null $guardName
     *
     * @return Role|array
     * @throws RoleDoesNotExist
     */
    public function findByName(string $roleName, ?string $guardName = null);
}
