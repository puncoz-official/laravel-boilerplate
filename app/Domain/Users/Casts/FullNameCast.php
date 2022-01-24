<?php

namespace App\Domain\Users\Casts;

use App\Domain\Users\DTO\FullNameDto;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FullNameCast
 *
 * @package App\Domain\Users\Casts
 */
class FullNameCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param Model  $model
     * @param string $key
     * @param object $value
     * @param array  $attributes
     *
     * @return FullNameDto
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return new FullNameDto((array) $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model       $model
     * @param string      $key
     * @param FullNameDto $value
     * @param array       $attributes
     *
     * @return array
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value->toArray();
    }
}
