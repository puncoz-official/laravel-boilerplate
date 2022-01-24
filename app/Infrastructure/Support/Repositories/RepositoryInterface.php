<?php

namespace App\Infrastructure\Support\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface as BaseRepositoryInterface;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Interface RepositoryInterface
 *
 * @package App\Infrastructure\Support\Repositories
 */
interface RepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Push Criteria for filter the query
     *
     * @param CriteriaInterface $criteria
     *
     * @return $this
     * @throws RepositoryException
     */
    public function pushCriteria($criteria);

    /**
     * @return Builder|Model
     */
    public function getBuilder();

    /**
     * @param string $column
     * @param array  $values
     *
     * @return void
     */
    public function deleteWhereNotIn(string $column, array $values): void;
}
