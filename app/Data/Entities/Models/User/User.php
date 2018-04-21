<?php

namespace App\Data\Entities\Models\User;

use App\Constants\DBTable;
use App\Data\Entities\Traits\UuidTrait;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Data\Entities\Models\User
 *
 * ============ Attributes =================
 * @property string  $id
 * @property string  $username
 * @property string  $email
 * @property string  $password
 * @property string  $display_name
 * @property boolean $is_first_login
 * @property string  $created_by
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
    use HasRoles;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = DBTable::AUTH_USERS;

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
        'is_first_login',
        'created_by',
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
                $user->setAttribute('created_by', is_null(currentUser()) ? null : currentUser()->id);
            }
        );

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

    /**
     * @param string $password
     */
    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = app('hash')->needsRehash($password) ? Hash::make($password) : $password;
    }
}
