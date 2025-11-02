<?php

namespace App\Trait;

use App\Dto\Pagination\PaginationDto;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
trait Paginator
{
    /**
     * @param QueryBuilder $qb
     * @param int $page
     * @param int $perPage
     * @return array{0: DoctrinePaginator, 1: PaginationDto}
     */
    public function paginate(QueryBuilder $qb, int $page = 1, int $perPage = 15): array
    {
        $firstResult = ($page - 1) * $perPage;

        $query = $qb
            ->setFirstResult($firstResult)
            ->setMaxResults($perPage)
            ->getQuery();

        $paginator = new DoctrinePaginator($query, true);

        $totalItems = count($paginator);
        $lastPage = (int) ceil($totalItems / $perPage);

        return [
            $paginator,
            new PaginationDto($totalItems, $page, $perPage, $lastPage)
        ];
    }
}
