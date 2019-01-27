<?php

namespace App\Data\Repositories\User;

use App\Core\BaseClasses\Repositories\RepositoryInterface;
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
     * @return mixed
     * @throws RepositoryException
     * @throws ModelNotFoundException
     */
    public function findByEmailOrUsername(string $emailOrUsername, array $columns = ['*']);
}
