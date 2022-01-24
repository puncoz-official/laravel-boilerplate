<?php

use App\Domain\Modules\Repositories\ModulesEloquentRepository;
use App\Domain\Modules\Repositories\ModulesRepository;
use App\Domain\Users\Repositories\PermissionsEloquentRepository;
use App\Domain\Users\Repositories\PermissionsRepository;
use App\Domain\Users\Repositories\RolesEloquentRepository;
use App\Domain\Users\Repositories\RolesRepository;
use App\Domain\Users\Repositories\UsersEloquentRepository;
use App\Domain\Users\Repositories\UsersRepository;

return [
    RolesRepository::class       => RolesEloquentRepository::class,
    PermissionsRepository::class => PermissionsEloquentRepository::class,
    ModulesRepository::class     => ModulesEloquentRepository::class,
    UsersRepository::class       => UsersEloquentRepository::class,
];
