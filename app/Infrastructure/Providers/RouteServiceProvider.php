<?php

namespace App\Infrastructure\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            if ( !$this->app->environment('production') ) {
                Route::prefix('dev')->middleware(['web'])->group(base_path('routes/dev.php'));
            }

            Route::domain(config('config.domain.api'))->middleware('api')->group(base_path('routes/api.php'));
            Route::domain(config('config.domain.admin'))->middleware(['web', 'admin'])->group(
                base_path('routes/admin.php')
            );
            Route::domain(config('config.domain.base'))->middleware('web')->group(base_path('routes/front.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
