<?php

namespace App\Domain\Auth\Services\Users;

use App\Data\Entities\User\User;
use App\Data\Repositories\User\UserRepository;

/**
 * Class UserService
 * @package App\Domain\Auth\Services\Users
 */
class UserService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $data
     *
     * @return User
     */
    public function register($data): User
    {
        $role = config('static-data.roles_permissions.roles.member');

        /** @var User $user */
        $user = $this->repository->create($data);
        $user->assignRole($role);

        return $user;
    }
}
