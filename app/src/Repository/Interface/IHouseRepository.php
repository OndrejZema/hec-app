<?php

namespace App\Repository\Interface;

use App\Dto\House\HouseDto;
use App\Dto\Pagination\PaginationDto;
use App\Entity\House;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;

interface IHouseRepository
{
    public function getById(User $user, int $id): ?House;

    /**
     * @return array{0: array<House>, 1: PaginationDto}
     */
    public function getAll(User $user, int $page, int $perPage): array;

    /**
     * @param User $user
     * @return array<House>
     */
    public function getForUser(User $user): array;

    public function getCurrentForUser(User $user): ?House;

    public function save(House $house, bool $flush = true): void;

    public function delete(User $user, int $id, bool $flush = true): void;

}
