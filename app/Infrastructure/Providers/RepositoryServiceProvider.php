<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        collect(config('bindings.repositories'))->each(
            fn(string $implementation, string $contract) => $this->app->bind($contract, $implementation)
        );
    }
}
