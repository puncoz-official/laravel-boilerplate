<?php

namespace App\StartUp\Providers;

use App\Data\Repositories\RepositoryBindings;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\StartUp\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    use RepositoryBindings;

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
