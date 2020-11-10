<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Trait PaginationTrait
 * @package App\Repository
 */
trait PaginationTrait
{
    /**
     * @param QueryBuilder $qb
     * @param int $limit
     * @param int $start
     * @return Pagerfanta
     */
    protected function paginate(QueryBuilder $qb, int $limit = 10, int $start = 0)
    {
        $pager = new Pagerfanta(new QueryAdapter($qb));
        $currentPage = ceil(($start + 1) / $limit);
        $pager->setCurrentPage($currentPage);
        $pager->setMaxPerPage($limit);

        return $pager;
    }
}
