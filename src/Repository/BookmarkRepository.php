<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Pagerfanta;

/**
 * Class BookmarkRepository
 * @package App\Repository
 */
class BookmarkRepository extends EntityRepository
{
    use PaginationTrait;

    /**
     * @param int $limit
     * @param int $start
     * @return Pagerfanta
     */
    public function list(int $limit = 10, int $start = 0)
    {
        $qb = $this
            ->createQueryBuilder('b')
            ->select('b')
        ;

        return $this->paginate($qb, $limit, $start);
    }
}
