<?php

namespace App\Infrastructure\Providers;

use App\Domain\Users\Actions\DeleteUser;
use App\Infrastructure\Middleware\JetstreamInertiaData;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Http\Middleware\ShareInertiaData;
use Laravel\Jetstream\Jetstream;

/**
 * Class JetstreamServiceProvider
 *
 * @package App\Infrastructure\Providers
 */
class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->instance(ShareInertiaData::class, new JetstreamInertiaData());
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
