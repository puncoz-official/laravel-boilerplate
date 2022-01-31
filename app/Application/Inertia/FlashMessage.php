<?php

namespace App\Application\Inertia;

use App\Infrastructure\Support\Inertia\InertiaDataSharable;
use Closure;

/**
 * Class FlashMessage
 *
 * @package App\Application\Inertia
 */
class FlashMessage implements InertiaDataSharable
{
    public function key(): string
    {
        return 'flash';
    }

    public function data(): Closure|array
    {
        return function () {
            return [
                'message' => session()->get('message'),
                'success' => session()->get('success'),
                'error'   => session()->get('error'),
                'warning' => session()->get('warning'),
                'info'    => session()->get('info'),
            ];
        };
    }
}
