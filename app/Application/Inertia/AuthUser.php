<?php

namespace App\Application\Inertia;

use App\Infrastructure\Support\Helpers\AuthHelper;
use App\Infrastructure\Support\Inertia\InertiaDataSharable;
use Closure;

/**
 * Class AuthUser
 *
 * @package App\Application\Inertia
 */
class AuthUser implements InertiaDataSharable
{
    public function key(): string
    {
        return 'auth.user';
    }

    public function data(): Closure|array
    {
        return function () {
            if ( !AuthHelper::isLoggedIn() ) {
                return null;
            }

            return AuthHelper::transformed();
        };
    }
}
