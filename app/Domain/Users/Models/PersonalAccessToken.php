<?php

namespace App\Domain\Users\Models;

use App\Enums\DBTables;
use Laravel\Sanctum\PersonalAccessToken as BasePersonalAccessToken;

/**
 * Class PersonalAccessToken
 *
 * @package App\Domain\Users\Models
 */
class PersonalAccessToken extends BasePersonalAccessToken
{
    protected $table = DBTables::AUTH_PERSONAL_ACCESS_TOKENS;
}
