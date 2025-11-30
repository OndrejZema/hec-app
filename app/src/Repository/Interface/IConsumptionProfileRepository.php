<?php

namespace App\Repository\Interface;

use App\Dto\Pagination\PaginationDto;
use App\Entity\ConsumptionProfile;
use App\Entity\User;

interface IConsumptionProfileRepository
{
    public function getById(User $user, int $id): ?ConsumptionProfile;

    /**
     * @return array{0: array<ConsumptionProfile>, 1: PaginationDto}
     */
    public function getAll(User $user, int $houseId, int $page, int $perPage): array;

    public function save(ConsumptionProfile $consumptionProfile, bool $flush = true): void;

    public function delete(User $user, int $id, bool $flush = true): void;
}
