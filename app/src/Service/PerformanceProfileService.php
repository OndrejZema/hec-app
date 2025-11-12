<?php

namespace App\Service;

use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\PerformanceProfileDto;
use App\Dto\PerformanceProfile\UpdatePerformanceProfileDto;
use App\Entity\User;
use App\Service\Interface\IPerformanceProfileService;

class PerformanceProfileService implements IPerformanceProfileService
{
    public function __construct(protected IPerformanceProfileRepository $performanceProfileRepository){}

    public function getById(User $user, int $id): ?PerformanceProfileDto
    {
        // TODO: Implement getById() method.
    }

    public function getAll(User $user, int $houseId, int $page, int $perPage): array
    {
        // TODO: Implement getAll() method.
    }

    public function create(User $user, CreatePerformanceProfileDto $houseDto): void
    {
        // TODO: Implement create() method.
    }

    public function update(User $user, UpdatePerformanceProfileDto $houseDto): void
    {
        // TODO: Implement update() method.
    }

    public function delete(User $user, int $id): void
    {
        // TODO: Implement delete() method.
    }

    public function activate(User $user, int $houseId, int $id): void
    {
        // TODO: Implement activate() method.
    }
}
