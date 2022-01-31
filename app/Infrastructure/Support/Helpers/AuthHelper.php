<?php

namespace App\Infrastructure\Support\Helpers;

use App\Application\Admin\Transformers\Users\AuthUserTransformer;
use App\Domain\Users\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class AuthHelper
 *
 * @package App\Infrastructure\Support\Helpers
 */
class AuthHelper
{
    public static function userId(): int
    {
        return self::currentUser()->id;
    }

    public static function isLoggedIn(): bool
    {
        return !auth()->guest();
    }

    public static function currentUser(): Authenticatable|User|null
    {
        return auth()->user();
    }

    public static function transformed(): array
    {
        $user = self::currentUser();

        return Helper::transform($user, new AuthUserTransformer());
    }
}
