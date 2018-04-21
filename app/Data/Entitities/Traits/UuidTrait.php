<?php

namespace App\Data\Entitities\Traits;

use Webpatser\Uuid\Uuid;

/**
 * Trait UuidTrait
 * @package App\Data\Entitities\Traits
 */
trait UuidTrait
{
    /**
     * Boot function from laravel.
     */
    protected static function bootUuidTrait()
    {
        static::creating(
            function ($model) {
                $model->{$model->getKeyName()} = (string) Uuid::generate()->string;
            }
        );
    }
}
