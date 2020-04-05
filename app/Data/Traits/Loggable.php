<?php

namespace App\Data\Traits;

use App\Core\Jobs\LogActivity;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait Loggable
 * @package App\Data\Traits
 */
trait Loggable
{
    /**
     * Boot method for creating, updating and deleting models.
     */
    public static function bootLoggable()
    {
        static::created(
            function (Model $model) {
                $description = sprintf("%s_db_added", class_basename(get_class($model)));
                $causer      = currentUser() ? currentUser()->id : null;
                $subject     = $model;
                $properties  = $model->toArray();

                dispatch(new LogActivity($description, $causer, $subject, $properties))->onQueue('log');
            }
        );

        static::updated(
            function (Model $model) {
                $description = sprintf("%s_db_updated", class_basename(get_class($model)));
                $causer      = currentUser() ? currentUser()->id : null;
                $subject     = $model;
                $properties  = $model->toArray();

                dispatch(new LogActivity($description, $causer, $subject, $properties))->onQueue('log');
            }
        );

        static::deleted(
            function (Model $model) {
                $description = sprintf("%s_db_deleted", class_basename(get_class($model)));
                $causer      = currentUser() ? currentUser()->id : null;
                $subject     = $model;

                dispatch(new LogActivity($description, $causer, $subject))->onQueue('log');
                logger()->info(sprintf("%s deleted", get_class($model)), $model->toArray());
            }
        );
    }
}
