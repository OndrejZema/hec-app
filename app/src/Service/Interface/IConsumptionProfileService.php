<?php

namespace App\Service\Interface;

use App\Dto\Pagination\PaginationDto;
use App\Dto\ConsumptionProfile\CreateConsumptionProfileDto;
use App\Dto\ConsumptionProfile\ConsumptionProfileDto;
use App\Dto\ConsumptionProfile\UpdateConsumptionProfileDto;
use App\Entity\User;

interface IConsumptionProfileService
{
    public function getById(User $user, int $id): ?ConsumptionProfileDto;

    /**
     * @return array{0: array<ConsumptionProfileDto>, 1: PaginationDto}
     */
    public function getAll(User $user, int $houseId, int $page, int $perPage): array;

    public function create(User $user, CreateConsumptionProfileDto $consumptionProfileDto): void;

    public function update(User $user, UpdateConsumptionProfileDto $consumptionProfileDto): void;

    public function delete(User $user, int $id): void;

    public function switchProfile(User $user, int $houseId, int $id): void;
}
