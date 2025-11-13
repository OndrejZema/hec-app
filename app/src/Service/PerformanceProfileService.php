<?php

namespace App\Service;

use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\PerformanceProfileDto;
use App\Dto\PerformanceProfile\UpdatePerformanceProfileDto;
use App\Entity\User;
use App\Mapper\PerformanceProfileMapper;
use App\Repository\Interface\IPerformanceProfileRepository;
use App\Service\Interface\IPerformanceProfileService;

class PerformanceProfileService implements IPerformanceProfileService
{
    public function __construct(
        protected IPerformanceProfileRepository $performanceProfileRepository,
        protected PerformanceProfileMapper      $performanceProfileMapper
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
        list($performanceProfiles, $pagination) = $this->performanceProfileRepository->getAll($user, $page, $perPage);
//        $selectedId = $this->getSelectedId($user);
        $activeId = 0;
        return [array_map(function ($model) use($activeId) {
            $dto = $this->performanceProfileMapper->toDto($model);
//            $dto->isActive = $activeId === $dto->id;
            return $dto;
        }, $performanceProfiles), $pagination];
    }

    public function create(User $user, CreatePerformanceProfileDto $performanceProfileDto): void
    {
        $house = $this->performanceProfileMapper->toEntity($performanceProfileDto, $user);

        $this->performanceProfileRepository->save($house);
    }

    public function update(User $user, UpdatePerformanceProfileDto $performanceProfileDto): void
    {
        $house = $this->performanceProfileRepository->getById($user, $performanceProfileDto->id);
        if ($house === null) {
            //@todo throw exception
        }
        $house->setName($performanceProfileDto->name);
        $house->setDescription($performanceProfileDto->description);
        $this->performanceProfileRepository->save($house);
    }

    public function delete(User $user, int $id): void
    {
        $this->performanceProfileRepository->delete($user, $id);
    }

    public function activate(User $user, int $houseId, int $id): void
    {
        // TODO: Implement activate() method.
    }
}
