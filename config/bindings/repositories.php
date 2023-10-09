<?php

return [
    App\Domain\User\Repositories\UserRepository::class => App\Domain\User\Repositories\UserEloquentRepository::class,
    App\Domain\Team\Repositories\TeamRepository::class => App\Domain\Team\Repositories\TeamEloquentRepository::class,
];
