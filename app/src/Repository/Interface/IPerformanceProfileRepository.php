<?php

namespace App\Repository\Interface;

use App\Dto\Pagination\PaginationDto;
use App\Entity\House;
use App\Entity\PerformanceProfile;
use App\Entity\User;

interface IPerformanceProfileRepository
{
    public function getById(User $user, int $id): ?PerformanceProfile;

    /**
     * @return array{0: array<PerformanceProfile>, 1: PaginationDto}
     */
    public function getAll(User $user, int $page, int $perPage): array;

    public function save(PerformanceProfile $performanceProfile, bool $flush = true): void;

    public function delete(User $user, int $id, bool $flush = true): void;
}
