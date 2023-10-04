<?php

namespace App\Domain\Team\Actions;

use App\Domain\Team\Models\Team;
use Laravel\Jetstream\Contracts\DeletesTeams;

/**
 * Class DeleteTeam
 */
class DeleteTeam implements DeletesTeams
{
    /**
     * Delete the given team.
     */
    public function delete(Team $team): void
    {
        $team->purge();
    }
}
