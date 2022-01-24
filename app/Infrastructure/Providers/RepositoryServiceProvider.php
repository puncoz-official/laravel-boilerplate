<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 *
 * @package App\Infrastructure\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        collect(config('bindings.repositories'))->each(function (string $implementation, string $contract) {
            $this->app->bind($contract, $implementation);
        });
    }
}
