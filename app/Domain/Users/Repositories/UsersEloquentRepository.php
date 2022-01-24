<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Models\User;
use App\Infrastructure\Support\Repositories\Repository;

/**
 * Class UsersEloquentRepository
 *
 * @package App\Domain\Users\Repositories
 */
class UsersEloquentRepository extends Repository implements UsersRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function byRole(string $role): self
    {
        /** @phpstan-ignore-next-line */
        $this->model = $this->model->role($role);

        return $this;
    }
}
