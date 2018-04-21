<?php

namespace App\Data\Entitities\Traits;

use Webpatser\Uuid\Uuid;

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
