<?php

namespace App\Data\Entities\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Trait UuidTrait
 * @package App\Data\Entities\Traits
 */
trait UuidTrait
{
    /**
     * Boot function from laravel.
     */
    protected static function bootUuidTrait()
    {
        static::creating(
            function (Model $model) {
                $model->{$model->getKeyName()} = Uuid::uuid1()->toString();
            }
        );
    }
}
