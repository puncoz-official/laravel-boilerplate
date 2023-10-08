<?php

namespace App\Domain\User\Models;

use App\Domain\User\ValueObjects\FullName;
use App\Enums\DBTable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int             $id
 * @property FullName        $full_name
 * @property string          $email
 * @property CarbonInterface $email_verified_at
 * @property string          $username
 * @property string          $password
 * @property string          $remember_token
 * @property string          $profile_photo_path
 * @property object          $metadata
 * @property int             $created_by
 * @property int             $updated_by
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property CarbonInterface $deleted_at
 * @property int             $deleted_by
 * @property string          $two_factor_secret
 * @property string[]        $two_factor_recovery_codes
 * @property CarbonInterface $two_factor_confirmed_at
 * @property int             $current_team_id
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    protected $table = DBTable::AUTH_USERS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'username',
        'password',
        'metadata',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'current_team_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'full_name'               => FullName::class,
        'email_verified_at'       => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
