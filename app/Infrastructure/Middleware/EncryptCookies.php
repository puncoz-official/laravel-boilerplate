<?php

namespace App\Infrastructure\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Class EncryptCookies
 * @package App\Infrastructure\Middleware
 */
class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [//
    ];
}
