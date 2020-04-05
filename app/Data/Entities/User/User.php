<?php

namespace App\Data\Entities\User;

use App\Constants\DBTable;
use App\Core\Notifications\ResetPasswordNotification;
use App\Core\Notifications\VerifyEmail;
use App\Data\Traits\Loggable;
use App\Data\Traits\UserInfoTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Hashing\HashManager;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Data\Entities\User
 *
 * @property int    $id
 * @property string $username
 * @property string $email
 * @property object $full_name
 * @property Carbon first_login_at
 * @property Carbon email_verified_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property string display_name
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use UserInfoTrait;
    use Loggable;
    use UserAccessors;

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
        'full_name',
        'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'full_name' => 'object',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'email_verified_at',
        'first_login_at',
    ];

    /**
     * @param string $password
     *
     * @throws BindingResolutionException
     */
    public function setPasswordAttribute(string $password)
    {
        /** @var HashManager $hashManager */
        $hashManager                  = app()->make(HashManager::class);
        $this->attributes['password'] = $hashManager->needsRehash($password) ? $hashManager->make($password) : $password;
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
