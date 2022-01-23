<?php

namespace App\Infrastructure\Support\Inertia;

use Closure;

/**
 * Interface InertiaDataSharable
 *
 * @package App\Infrastructure\Support\Inertia
 */
interface InertiaDataSharable
{
    /**
     * @return string
     */
    public function key(): string;

    /**
     * @return Closure|array
     */
    public function data(): Closure|array;
}
