<?php

namespace App\StartUp\Providers;

use App\Data\Repositories\User\UserEloquentRepository;
use App\Data\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\StartUp\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $repositories = [
        UserRepository::class => UserEloquentRepository::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        collect($this->repositories)->each(
            function (string $implementation, string $interface) {
                $this->app->bind($interface, $implementation);
            }
        );
    }
}
