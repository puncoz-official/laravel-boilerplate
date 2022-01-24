<?php

namespace App\Infrastructure\Support\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class Repository
 *
 * @package App\Infrastructure\Support\Repositories
 */
abstract class Repository extends BaseRepository
{
    abstract public function model(): string;

    /**
     * @return Builder|Model
     */
    public function getBuilder()
    {
        $this->applyCriteria();
        $this->applyScope();

        return $this->model;
    }

    /**
     * @param string $column
     * @param array  $values
     *
     * @return void
     * @throws RepositoryException
     */
    public function deleteWhereNotIn(string $column, array $values): void
    {
        $this->getBuilder()->whereNotIn($column, $values)->delete();

        $this->resetModel();
    }
}
