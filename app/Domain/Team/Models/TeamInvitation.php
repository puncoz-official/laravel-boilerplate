<?php

namespace App\Domain\Team\Models;

use App\Enums\DBTable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\TeamInvitation as BaseTeamInvitation;

/**
 * Class TeamInvitation
 *
 * @property int             $id
 * @property int             $team_id
 * @property string          $email
 * @property string          $role
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class TeamInvitation extends BaseTeamInvitation
{
    protected $table = DBTable::AUTH_TEAM_INVITATIONS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'role',
    ];

    /**
     * Get the team that the invitation belongs to.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Jetstream::teamModel());
    }
}
