<?php

namespace App\StartUp\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

/**
 * Class TrustProxies
 * @package App\StartUp\Middleware
 */
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
