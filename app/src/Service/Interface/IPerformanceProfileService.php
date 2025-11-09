<?php

namespace App\Service\Interface;

use App\Dto\Pagination\PaginationDto;
use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\PerformanceProfileDto;
use App\Dto\PerformanceProfile\UpdatePerformanceProfileDto;
use App\Entity\User;

interface IPerformanceProfileService
{
    public function getById(User $user, int $id): ?PerformanceProfileDto;

    /**
     * @return array{0: array<PerformanceProfileDto>, 1: PaginationDto}
     */
    public function getAll(User $user, int $houseId, int $page, int $perPage): array;

    public function create(User $user, CreatePerformanceProfileDto $houseDto): void;

    public function update(User $user, UpdatePerformanceProfileDto $houseDto): void;

    public function delete(User $user, int $id): void;

    public function activate(User $user, int $houseId, int $id): void;

}
