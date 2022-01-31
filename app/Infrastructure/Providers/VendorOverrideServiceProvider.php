<?php

namespace App\Infrastructure\Providers;

use App\Infrastructure\Support\Fractal\CustomParamBag;
use App\Infrastructure\Support\Fractal\CustomScope;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use League\Fractal\ParamBag;
use League\Fractal\Scope;

/**
 * Class VendorOverrideServiceProvider
 *
 * @package App\Infrastructure\Providers
 */
class VendorOverrideServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias(ParamBag::class, CustomParamBag::class);
        $loader->alias(Scope::class, CustomScope::class);
    }
}
