<?php

namespace App\Infrastructure\Support\Casts;

use App\Infrastructure\Support\DataObject\DataObject;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;

/**
 * Class CastableValueObject
 */
abstract class CastableValueObject extends DataObject implements Castable
{

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param array $arguments
     *
     * @return class-string<CastsAttributes|CastsInboundAttributes>|CastsAttributes|CastsInboundAttributes
     */
    public static function castUsing(array $arguments)
    {
        return new ValueObjectCast(static::class, $arguments);
    }
}
