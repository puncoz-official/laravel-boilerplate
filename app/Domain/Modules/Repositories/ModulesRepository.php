<?php

namespace App\Domain\Modules\Repositories;

use App\Domain\Modules\Models\Module;
use App\Infrastructure\Support\Repositories\RepositoryInterface;

/**
 * Interface ModulesRepository
 *
 * @package App\Domain\Modules\Repositories
 */
interface ModulesRepository extends RepositoryInterface
{
    /**
     * @param string $name
     *
     * @return Module|array
     */
    public function findByName(string $name): Module|array;
}
