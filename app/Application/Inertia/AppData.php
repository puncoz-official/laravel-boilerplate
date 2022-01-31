<?php

namespace App\Application\Inertia;

use App\Infrastructure\Support\Inertia\InertiaDataSharable;
use Closure;

/**
 * Class AppData
 *
 * @package App\Application\Inertia
 */
class AppData implements InertiaDataSharable
{
    public function key(): string
    {
        return 'app';
    }

    public function data(): Closure|array
    {
        return [
            'name' => config('app.name'),
        ];
    }
}
