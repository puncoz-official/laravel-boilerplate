<?php

namespace App\Data\Repositories\User;

use App\Core\BaseClasses\Repositories\Repository;
use App\Data\Entities\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class UserEloquentRepository
 * @package App\Data\Repositories\User
 */
class UserEloquentRepository extends Repository implements UserRepository
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

    /**
     * @param string $emailOrUsername
     * @param array  $columns
     *
     * @return mixed
     * @throws RepositoryException
     * @throws ModelNotFoundException
     */
    public function findByEmailOrUsername(string $emailOrUsername, array $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        /** @var Builder $model */
        $model = $this->model;

        $user = $model->where(
            function (Builder $query) use ($emailOrUsername) {
                $query->orWhere('email', $emailOrUsername);
                $query->orWhere('username', $emailOrUsername);
            }
        )->firstOrFail($columns);

        $this->resetModel();

        return $this->parserResult($user);
    }
}
