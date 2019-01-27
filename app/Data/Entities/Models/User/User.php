<?php

namespace App\Data\Entities\Models\User;

use App\Constants\DBTable;
use App\Data\Entities\Traits\UserInfoTrait;
use App\Data\Entities\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Hashing\HashManager;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Data\Entities\Models\User
 *
 * @property string id
 * @property string username
 * @property string email
 * @property object full_name
 * @property Carbon first_login_at
 * @property Carbon email_verified_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles, UuidTrait, SoftDeletes, UserInfoTrait;

    /**
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
        'full_name',
        'first_login_at',
        'email_verified_at',
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
        'full_name' => 'object',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'first_login_at',
        'email_verified_at',
    ];

    /**
     * @param string $password
     */
    public function setPasswordAttribute(string $password)
    {
        /** @var HashManager $hashManager */
        $hashManager                  = app()->make(HashManager::class);
        $this->attributes['password'] = $hashManager->needsRehash($password) ? $hashManager->make($password) : $password;
    }
}
