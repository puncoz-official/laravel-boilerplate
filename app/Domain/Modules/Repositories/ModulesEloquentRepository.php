<?php

namespace App\Domain\Modules\Repositories;

use App\Domain\Modules\Models\Module;
use App\Infrastructure\Support\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class ModulesEloquentRepository
 *
 * @package App\Domain\Modules\Repositories
 */
class ModulesEloquentRepository extends Repository implements ModulesRepository
{
    public function model(): string
    {
        return Module::class;
    }

    /**
     * @param string $name
     *
     * @return Module|array
     * @throws RepositoryException
     */
    public function findByName(string $name): Module|array
    {
        $modules = $this->getBuilder()->where('name', $name)->get();

        $this->resetModel();
        if ( $modules->isEmpty() ) {
            throw new ModelNotFoundException();
        }

        return $this->parserResult($modules->first());
    }
}
