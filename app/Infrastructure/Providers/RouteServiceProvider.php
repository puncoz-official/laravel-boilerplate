<?php

namespace App\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Routing\Router as ApiRoute;

/**
 * Class RouteServiceProvider
 * @package App\Infrastructure\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * These namespaces are applied to your controller routes.
     *
     * In addition, these are set as the URL generator's root namespace.
     *
     * @var array
     */
    protected $namespace = [
        'admin' => 'App\Domain\Admin\Controllers',
        'api'   => 'App\Domain\Api\Controllers',
        'auth'  => 'App\Domain\Auth\Controllers',
        'front' => 'App\Domain\Front\Controllers',
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
     * @param Router   $routes
     * @param ApiRoute $api
     *
     * @return void
     */
    public function map(Router $routes, ApiRoute $api)
    {
        $this->mapAdminRoutes($routes);
        $this->mapApiRoutes($api);
        $this->mapAuthRoutes($routes);
        $this->mapFrontRoutes($routes);
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param Router $routes
     *
     * @return void
     */
    protected function mapAdminRoutes(Router $routes)
    {
        $routes->group(
            [
                'namespace'  => $this->namespace['admin'],
                'prefix'     => config('config.route_prefixes.admin'),
                'middleware' => ['web', 'auth'],
                'as'         => 'admin',
            ],
            function () use ($routes) {
                require_once base_path('routes/admin.php');
            }
        );
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @param ApiRoute $api
     *
     * @return void
     */
    protected function mapApiRoutes(ApiRoute $api)
    {
        $api->group(
            [
                'namespace'  => $this->namespace['api'],
                'prefix'     => config('config.route_prefixes.api'),
                'middleware' => 'api',
                'as'         => 'api',
            ],
            function () use ($api) {
                require_once base_path('routes/api.php');
            }
        );
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param Router $routes
     *
     * @return void
     */
    protected function mapAuthRoutes(Router $routes)
    {
        $routes->group(
            [
                'namespace'  => $this->namespace['auth'],
                'as'         => 'auth',
                'middleware' => 'web',
            ],
            function () use ($routes) {
                require_once base_path('routes/auth.php');
            }
        );
    }

    /**
     * Define the "front" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param Router $routes
     *
     * @return void
     */
    protected function mapFrontRoutes(Router $routes)
    {
        $routes->group(
            [
                'namespace'  => $this->namespace['front'],
                'as'         => 'front',
                'middleware' => 'web',
            ],
            function () use ($routes) {
                require_once base_path('routes/front.php');
            }
        );
    }
}
