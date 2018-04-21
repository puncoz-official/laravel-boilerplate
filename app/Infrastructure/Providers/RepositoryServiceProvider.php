<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Infrastructure\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $repositories = [];

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
