<?php

namespace App\Data\Repositories;

use App\Data\Repositories\User\Permission\PermissionEloquentRepository;
use App\Data\Repositories\User\Permission\PermissionRepository;
use App\Data\Repositories\User\Role\RoleEloquentRepository;
use App\Data\Repositories\User\Role\RoleRepository;
use App\Data\Repositories\User\UserEloquentRepository;
use App\Data\Repositories\User\UserRepository;

/**
 * Trait RepositoryBindings
 * @package App\Data\Repositories
 */
trait RepositoryBindings
{
    /**
     * @var array
     */
    protected $repositories = [
        PermissionRepository::class => PermissionEloquentRepository::class,
        RoleRepository::class       => RoleEloquentRepository::class,
        UserRepository::class       => UserEloquentRepository::class,
    ];
}
