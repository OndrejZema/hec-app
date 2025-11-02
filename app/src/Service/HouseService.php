<?php

namespace App\Service;

use App\Dto\House\CreateHouseDto;
use App\Dto\House\HouseDto;
use App\Dto\House\UpdateHouseDto;
use App\Entity\User;
use App\Mapper\HouseMapper;
use App\Repository\Interface\IHouseRepository;
use App\Service\Interface\IHouseService;
use App\Service\Interface\IHouseVisitService;

class HouseService implements IHouseService
{

    public function __construct(
        protected IHouseRepository   $houseRepository,
        protected IHouseVisitService $houseVisitService,
        protected HouseMapper        $houseMapper
    )
    {
    }

    public function getById(User $user, int $id): ?HouseDto
    {
        $house = $this->houseRepository->getById($user, $id);
        if ($house === null) {
            return null;
        }

        return $this->houseMapper->toDto($house);
    }

    public function getAll(User $user, int $page, int $perPage): array
    {
        list($houses, $pagination) = $this->houseRepository->getAll($user, $page, $perPage);
        $selectedId = $this->getSelectedId($user);
        return [array_map(function ($house) use($selectedId) {
            $dto = $this->houseMapper->toDto($house);
            $dto->isSelected = $selectedId === $dto->id;
            return $dto;
        }, $houses), $pagination];
    }

    public function create(User $user, CreateHouseDto $houseDto): void
    {
        $house = $this->houseMapper->toEntity($houseDto, $user);

        $this->houseRepository->save($house);
    }

    public function update(User $user, UpdateHouseDto $houseDto): void
    {
        $house = $this->houseRepository->getById($user, $houseDto->id);
        if ($house === null) {
            //@todo throw exception
        }
        $house->setName($houseDto->name);
        $house->setDescription($houseDto->description);
        $this->houseRepository->save($house);
    }

    public function delete(User $user, int $id): void
    {
        $this->houseRepository->delete($user, $id);
    }

    public function visit(User $user, int $id): void
    {
        $house = $this->houseRepository->getById($user, $id);
        if ($house === null) {
            //@todo throw exception
        }
        $this->houseVisitService->visit($user, $house);
    }

    public function getSelectedId(User $user): ?int
    {
        return $this->houseVisitService->getSelectedId($user);
    }
}
