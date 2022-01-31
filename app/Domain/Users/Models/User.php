<?php

namespace App\Domain\Users\Models;

use App\Domain\Users\Casts\FullNameCast;
use App\Domain\Users\DTO\FullNameDto;
use App\Domain\Users\Models\Accessors\UsersAccessors;
use App\Enums\DBTables;
use App\Enums\General;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Hashing\HashManager;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @package App\Domain\Users\Models
 *
 * @property int         $id
 * @property FullNameDto $full_name
 * @property string      $email
 * @property Carbon|null $email_verified_at
 * @property string      $password
 * @property string|null $remember_token
 * @property string      $two_factor_secret
 * @property array       $two_factor_recovery_codes
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property string      $profile_photo_url
 * @property bool        $is_email_verified
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use UsersAccessors;
    use InteractsWithMedia;

    public const PROFILE_PICTURE = 'profile_picture';

    protected $table = DBTables::AUTH_USERS;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'email',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
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
     * @var array
     */
    protected $dates = [
        'email_verified_at',
    ];

    protected $casts = [
        'full_name'                 => FullNameCast::class,
        'two_factor_recovery_codes' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return UserFactory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::PROFILE_PICTURE)->singleFile()->withResponsiveImages();
    }

    /**
     * @param Media|null $media
     *
     * @return void
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(General::IMAGE_SIZE_THUMB->value);
        $this->addMediaConversion('small')->width(General::IMAGE_SIZE_SMALL->value);
        $this->addMediaConversion('medium')->width(General::IMAGE_SIZE_MEDIUM->value);
        $this->addMediaConversion('large')->width(General::IMAGE_SIZE_LARGE->value);
    }

    /**
     * @param string $password
     *
     * @throws BindingResolutionException
     */
    public function setPasswordAttribute(string $password): void
    {
        /** @var HashManager $hashManager */
        $hashManager                  = app()->make(HashManager::class);
        $this->attributes['password'] = $hashManager->needsRehash($password) ? $hashManager->make($password)
            : $password;
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode(
                $this->full_name->toString()
            ).'&color=333333&background=F8D22C';
    }
}
