<?php

namespace App\Service\Interface;

use App\Dto\House\CreateHouseDto;
use App\Dto\House\HouseDto;
use App\Dto\House\UpdateHouseDto;
use App\Dto\Pagination\PaginationDto;
use App\Entity\User;

interface IHouseService
{
    public function getById(User $user, int $id): ?HouseDto;

    /**
     * @return array{0: array<HouseDto>, 1: PaginationDto}
     */
    public function getAll(User $user, int $page, int $perPage): array;

    public function create(User $user, CreateHouseDto $houseDto): void;

    public function update(User $user, UpdateHouseDto $houseDto): void;

    public function delete(User $user, int $id): void;

    public function visit(User $user, int $id): void;

    public function getSelectedId(User $user): ?int;

}
