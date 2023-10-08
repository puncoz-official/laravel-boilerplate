<?php

namespace App\Domain\User\Models;

use App\Enums\DBTable;
use Carbon\CarbonInterface;
use Laravel\Sanctum\PersonalAccessToken as BasePersonalAccessToken;

/**
 * Class PersonalAccessToken
 *
 * @property int             $id
 * @property string          $tokenable_type
 * @property int             $tokenable_id
 * @property string          $name
 * @property string          $token
 * @property array           $abilities
 * @property CarbonInterface $last_used_at
 * @property CarbonInterface $expires_at
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class PersonalAccessToken extends BasePersonalAccessToken
{
    protected $table = DBTable::AUTH_PERSONAL_ACCESS_TOKENS;
}
