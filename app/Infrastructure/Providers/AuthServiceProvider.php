<?php

namespace App\Infrastructure\Providers;

use App\Infrastructure\Abstracts\PersonalAccessToken;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Sanctum\Sanctum;

/**
 * Class AuthServiceProvider
 *
 * @package App\Infrastructure\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
