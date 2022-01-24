<?php

namespace App\Infrastructure\Abstracts;

use App\Enums\DBTables;

class PersonalAccessToken extends \Laravel\Sanctum\PersonalAccessToken
{
    protected $table = DBTables::AUTH_PERSONAL_ACCESS_TOKENS;
}
