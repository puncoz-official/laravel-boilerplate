<?php

namespace App\Domain\Team\Repositories;

use App\Domain\Team\Models\Team;
use App\Infrastructure\Support\Repositories\EloquentRepository;

/**
 * Class TeamEloquentRepository
 */
class TeamEloquentRepository extends EloquentRepository implements TeamRepository
{

    public function model(): string
    {
        return Team::class;
    }
}
