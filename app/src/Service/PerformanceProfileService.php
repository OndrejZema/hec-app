<?php

namespace App\Service;

use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\PerformanceProfileDto;
use App\Dto\PerformanceProfile\UpdatePerformanceProfileDto;
use App\Entity\User;
use App\Mapper\HouseMapper;
use App\Mapper\PerformanceProfileMapper;
use App\Repository\Interface\IHousePerformanceProfileRepository;
use App\Repository\Interface\IHouseRepository;
use App\Repository\Interface\IHouseVisitRepository;
use App\Repository\Interface\IPerformanceProfileRepository;
use App\Service\Interface\IPerformanceProfileService;

class PerformanceProfileService implements IPerformanceProfileService
{
    public function __construct(
        protected IPerformanceProfileRepository      $performanceProfileRepository,
        protected PerformanceProfileMapper           $performanceProfileMapper,
        protected IHouseRepository                   $houseRepository,
        protected IHouseVisitRepository              $houseVisitRepository,
        protected HouseMapper                        $houseMapper,
        protected IHousePerformanceProfileRepository $housePerformanceProfileRepository
    )
    {
    }

    public function getById(User $user, int $id): ?PerformanceProfileDto
    {
        $performanceProfile = $this->performanceProfileRepository->getById($user, $id);
        if ($performanceProfile === null) {
            return null;
        }

        return $this->performanceProfileMapper->toDto($performanceProfile);
    }

    public function getAll(User $user, int $houseId, int $page, int $perPage): array
    {
        list($performanceProfiles, $pagination) = $this->performanceProfileRepository->getAll($user, $houseId, $page, $perPage);
//        $selectedId = $this->getSelectedId($user);
        $activeId = 0;
        return [array_map(function ($model) use ($activeId) {
            $dto = $this->performanceProfileMapper->toDto($model);
//            $dto->isActive = $activeId === $dto->id;
            return $dto;
        }, $performanceProfiles), $pagination];
    }

    public function create(User $user, CreatePerformanceProfileDto $performanceProfileDto): void
    {
        $currentHouseId = $this->houseVisitRepository->getCurrentId($user);
        $house = $this->houseRepository->getById($user, $currentHouseId);

        $performanceProfile = $this->performanceProfileMapper->toEntity($performanceProfileDto, $house, $user);

        $this->performanceProfileRepository->save($performanceProfile);
    }

    public function update(User $user, UpdatePerformanceProfileDto $performanceProfileDto): void
    {
        $performanceProfile = $this->performanceProfileRepository->getById($user, $performanceProfileDto->id);
        if ($performanceProfile === null) {
            //@todo throw exception
        }
        $performanceProfile->setName($performanceProfileDto->name);
        $performanceProfile->setDescription($performanceProfileDto->description);
        $performanceProfile->setType($performanceProfileDto->type);
        $performanceProfile->setPerformanceIndex($performanceProfileDto->performanceIndex);
        $performanceProfile->setProfileDay($performanceProfileDto->profileDay);
        $performanceProfile->setProfileWeek($performanceProfileDto->profileWeek);
        $performanceProfile->setProfileMonth($performanceProfileDto->profileMonth);
        $performanceProfile->setProfileYear($performanceProfileDto->profileYear);
        $this->performanceProfileRepository->save($performanceProfile);
    }

    public function delete(User $user, int $id): void
    {
        $this->performanceProfileRepository->delete($user, $id);
    }

    public function select(User $user, int $houseId, int $id): void
    {
        $house = $this->houseRepository->getById($user, $houseId);
        $profile = $this->performanceProfileRepository->getById($user, $id);
        $this->housePerformanceProfileRepository->selectProfile($user, $house, $profile);
    }
}
