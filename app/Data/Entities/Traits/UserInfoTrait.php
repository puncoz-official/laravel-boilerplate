<?php

namespace App\Data\Entities\Traits;

use App\Data\Entities\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait UserInfoTrait
 * @package App\Data\Entities\Traits
 *
 * @property User creator
 * @property User updater
 * @property User destroyer
 */
trait UserInfoTrait
{
    /**
     * Boot method for creating, updating and deleting models.
     */
    public static function bootModelTrait()
    {
        static::creating(
            function (Model $model) {
                $model->setAttribute('created_by', is_null(currentUser()) ? null : currentUser()->id);
            }
        );

        static::updating(
            function (Model $model) {
                $model->setAttribute('updated_by', is_null(currentUser()) ? null : currentUser()->id);
            }
        );

        self::deleting(
            function (Model $model) {
                $model->setAttribute('deleted_by', is_null(currentUser()) ? null : currentUser()->id)->save();
            }
        );
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function destroyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
