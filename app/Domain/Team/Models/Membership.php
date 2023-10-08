<?php

namespace App\Domain\Team\Models;

use App\Enums\DBTable;
use Carbon\CarbonInterface;
use Laravel\Jetstream\Membership as BaseMembership;

/**
 * Class Membership
 *
 * @property int             $id
 * @property int             $team_id
 * @property int             $user_id
 * @property string          $role
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class Membership extends BaseMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = DBTable::AUTH_TEAM_USER;

    protected $fillable = [
        'role',
    ];
}
