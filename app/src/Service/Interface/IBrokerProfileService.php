<?php

namespace App\Service\Interface;

use App\Dto\BrokerProfile\BrokerProfileDto;
use App\Dto\BrokerProfile\CreateBrokerProfileDto;
use App\Dto\BrokerProfile\UpdateBrokerProfileDto;
use App\Dto\ConsumptionProfile\ConsumptionProfileDto;
use App\Dto\Pagination\PaginationDto;
use App\Entity\User;

interface IBrokerProfileService
{
    public function getById(User $user, int $id): ?BrokerProfileDto;

    /**
     * @return array{0: array<ConsumptionProfileDto>, 1: PaginationDto}
     */
    public function getAll(User $user, int $page, int $perPage): array;

    public function create(User $user, CreateBrokerProfileDto $brokerProfileDto): void;

    public function update(User $user, UpdateBrokerProfileDto $brokerProfileDto): void;

    public function delete(User $user, int $id): void;
}
