<?php

namespace App\Data\Repositories\User;

use App\Core\BaseClasses\Repository\RepositoryInterface;
use App\Data\Entities\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Interface UserRepository
 * @package App\Data\Repositories\User
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @param string $emailOrUsername
     * @param array  $columns
     *
     * @return User|array
     * @throws RepositoryException
     * @throws ModelNotFoundException
     */
    public function findByEmailOrUsername(string $emailOrUsername, array $columns = ['*']);
}
