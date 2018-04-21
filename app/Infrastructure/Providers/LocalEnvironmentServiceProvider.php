<?php

namespace App\Infrastructure\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class LocalEnvironmentServiceProvider
 * @package App\Infrastructure\Providers
 */
class LocalEnvironmentServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $localProviders = [
        IdeHelperServiceProvider::class,
    ];
    /**
     * @var array
     */
    protected $facadeAliases = [];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ( $this->app->environment() === 'local' ) {
            $this->registerServiceProviders();
            $this->registerFacadeAliases();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     *  Register service providers intended for local environment
     */
    protected function registerServiceProviders()
    {
        collect($this->localProviders)->each(
            function ($provider) {
                $this->app->register($provider);
            }
        );
    }

    /**
     *  Register aliases intended for local environment
     */
    protected function registerFacadeAliases()
    {
        collect($this->facadeAliases)->each(
            function ($facade, $alias) {
                dd($facade, $alias);
            }
        );
    }
}
