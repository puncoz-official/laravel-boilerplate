<?php

namespace App\Data\Entities\User;

use App\Data\Entitities\Traits\UuidTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Data\Entities\User
 *
 * ============ Attributes =================
 * @property string  $id
 * @property string  $username
 * @property string  $email
 * @property string  $password
 * @property string  $display_name
 * @property object  $full_name
 * @property boolean $is_first_login
 * @property string  $updated_by
 * @property string  $deleted_by
 *
 * ============ Relations ===================
 *
 * ============ Accessors ===================
 *
 */
class User extends Authenticatable
{
    use Notifiable, UuidTrait;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'display_name',
        'full_name',
        'is_first_login',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'full_name'      => 'object',
        'is_first_login' => 'boolean',
    ];

    /**
     * User Model Boot Method
     */
    public static function boot()
    {
        parent::boot();

        static::updating(
            function (User $user) {
                $user->setAttribute('updated_by', is_null(currentUser()) ? null : currentUser()->id);
            }
        );

        self::deleting(
            function (User $user) {
                $user->setAttribute('deleted_by', is_null(currentUser()) ? null : currentUser()->id)->save();
            }
        );
    }
}
