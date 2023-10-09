<?php

namespace App\Domain\Team\Models;

use App\Enums\DBTable;
use App\Enums\Role;
use Carbon\CarbonInterface;
use Laravel\Jetstream\Membership as BaseMembership;

/**
 * Class Membership
 *
 * @property int             $id
 * @property int             $team_id
 * @property int             $user_id
 * @property Role            $role
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

    protected $casts = [
        'role' => Role::class,
    ];
}
