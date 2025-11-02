<?php

namespace App\Dto\Pagination;

class PaginationDto
{
    public function __construct(
        public int $totalCount,
        public int $page,
        public int $perPage,
        public int $lastPage,
    ){}
}
