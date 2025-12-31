<?php

namespace App\Service;

use App\Dto\House\CreateHouseDto;
use App\Dto\House\HouseDto;
use App\Dto\House\UpdateHouseDto;
use App\Entity\User;
use App\Mapper\HouseMapper;
use App\Repository\Interface\IConsumptionProfileRepository;
use App\Repository\Interface\IHouseBrokerProfileRepository;
use App\Repository\Interface\IHouseRepository;
use App\Repository\Interface\IPerformanceProfileRepository;
use App\Service\Interface\IHouseService;
use App\Service\Interface\IHouseVisitService;

class HouseService implements IHouseService
{

    public function __construct(
        protected IHouseRepository              $houseRepository,
        protected IHouseVisitService            $houseVisitService,
        protected HouseMapper                   $houseMapper,
        protected IPerformanceProfileRepository $performanceProfileRepository,
        protected IConsumptionProfileRepository $consumptionProfileRepository,
        protected IHouseBrokerProfileRepository $houseBrokerProfileRepository,
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
        $currentId = $this->getCurrentId($user);
        return [array_map(function ($model) use ($currentId, $user) {
            $dto = $this->houseMapper->toDto($model);
            $currentHouseBrokerProfile = $this->houseBrokerProfileRepository->getCurrentProfile($user, $model);
            $dto->isCurrent = $currentId === $dto->id;
            $dto->performanceProfileCount = $this->performanceProfileRepository->getCountForHouse($user, $model);
            $dto->consumptionProfileCount = $this->consumptionProfileRepository->getCountForHouse($user, $model);
            $dto->brokerProfileName = $currentHouseBrokerProfile?->getBrokerProfile()->getName();
            $dto->hasActiveBrokerProfile = $currentHouseBrokerProfile?->isActive();
            return $dto;
        }, $houses), $pagination];
    }

    public function getForUser(User $user): array
    {
        $houses = $this->houseRepository->getForUser($user);

        return array_map(function ($house) {
            return $this->houseMapper->toDto($house);
        }, $houses);
    }

    public function getCurrentForUser(User $user): ?HouseDto
    {
        $houseId = $this->houseVisitService->getCurrentId($user);
        if ($houseId === null) {
            return null;
        }
        $house = $this->houseRepository->getById($user, $houseId);
        if ($house === null) {
            return null;
        }
        return $this->houseMapper->toDto($house);
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

    public function getCurrentId(User $user): ?int
    {
        return $this->houseVisitService->getCurrentId($user);
    }
}
