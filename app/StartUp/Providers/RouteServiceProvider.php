<?php

namespace App\StartUp\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class RouteServiceProvider
 * @package App\StartUp\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var array
     */
    protected $namespaces = [
        'back-office'  => 'App\Domain\BackOffice\Controllers',
        'api'          => 'App\Domain\Api\Controllers',
        'auth'         => 'App\Domain\Auth\Controllers',
        'front-office' => 'App\Domain\FrontOffice\Controllers',
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapFrontOfficeRoutes($router);
        $this->mapAuthRoutes($router);
        $this->mapBackOfficeRoutes($router);
        $this->mapApiRoutes($router);
    }

    /**
     * Define the "front" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param Router $router
     *
     * @return void
     */
    protected function mapFrontOfficeRoutes(Router $router)
    {
        $router->group(
            [
                'namespace'  => $this->namespaces['front-office'],
                'middleware' => ['web', 'front-office'],
                'as'         => 'front.',
            ],
            function () use ($router) {
                require_once base_path('routes/front-office.php');
            }
        );
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param Router $router
     *
     * @return void
     */
    protected function mapAuthRoutes(Router $router)
    {
        $router->group(
            [
                'namespace'  => $this->namespaces['auth'],
                'middleware' => 'web',
                'as'         => 'auth.',
            ],
            function () use ($router) {
                require_once base_path('routes/auth.php');
            }
        );
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive admin middleware, session state, CSRF protection, etc.
     *
     * @param Router $router
     *
     * @return void
     */
    protected function mapBackOfficeRoutes(Router $router)
    {
        $router->group(
            [
                'namespace'  => $this->namespaces['back-office'],
                'prefix'     => config('config.route_prefixes.back-office'),
                'middleware' => ['web', 'back-office'],
                'as'         => 'back.',
            ],
            function () use ($router) {
                require_once base_path('routes/back-office.php');
            }
        );
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @param Router $api
     *
     * @return void
     */
    protected function mapApiRoutes(Router $api)
    {
        $api->group(
            [
                'namespace'  => $this->namespaces['api'],
                'prefix'     => config('config.route_prefixes.api'),
                'middleware' => 'api',
                'as'         => 'api.',
            ],
            function () use ($api) {
                require_once base_path('routes/api.php');
            }
        );
    }
}
