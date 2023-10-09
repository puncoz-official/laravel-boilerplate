<?php

namespace App\Infrastructure\Support;

use Illuminate\Support\Collection;

/**
 * Trait EnumHelper
 */
trait EnumHelper
{
    public static function keys(): Collection
    {
        return collect(self::cases())->pluck('name');
    }

    public static function values(): Collection
    {
        return collect(self::cases())->pluck('value');
    }

    public static function implode(string $separator = ','): string
    {
        return implode($separator, self::values()->toArray());
    }
}
