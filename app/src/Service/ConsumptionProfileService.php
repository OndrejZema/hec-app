<?php

namespace App\Service;

use App\Dto\ConsumptionProfile\ConsumptionProfileDto;
use App\Dto\ConsumptionProfile\CreateConsumptionProfileDto;
use App\Dto\ConsumptionProfile\UpdateConsumptionProfileDto;
use App\Entity\User;
use App\Mapper\ConsumptionProfileMapper;
use App\Repository\Interface\IConsumptionProfileRepository;
use App\Service\Interface\IConsumptionProfileService;

class ConsumptionProfileService implements IConsumptionProfileService
{
    public function __construct(
        protected IConsumptionProfileRepository $consumptionProfileRepository,
        protected ConsumptionProfileMapper      $consumptionProfileMapper
    )
    {
    }

    public function getById(User $user, int $id): ?ConsumptionProfileDto
    {
        $consumptionProfile = $this->consumptionProfileRepository->getById($user, $id);
        if ($consumptionProfile === null) {
            return null;
        }

        return $this->consumptionProfileMapper->toDto($consumptionProfile);
    }

    public function getAll(User $user, int $houseId, int $page, int $perPage): array
    {
        list($consumptionProfiles, $pagination) = $this->consumptionProfileRepository->getAll($user, $page, $perPage);
//        $selectedId = $this->getSelectedId($user);
        $activeId = 0;
        return [array_map(function ($model) use($activeId) {
            $dto = $this->consumptionProfileMapper->toDto($model);
//            $dto->isActive = $activeId === $dto->id;
            return $dto;
        }, $consumptionProfiles), $pagination];
    }

    public function create(User $user, CreateConsumptionProfileDto $consumptionProfileDto): void
    {
        $house = $this->consumptionProfileMapper->toEntity($consumptionProfileDto, $user);

        $this->consumptionProfileRepository->save($house);
    }

    public function update(User $user, UpdateConsumptionProfileDto $consumptionProfileDto): void
    {
        $house = $this->consumptionProfileRepository->getById($user, $consumptionProfileDto->id);
        if ($house === null) {
            //@todo throw exception
        }
        $house->setName($consumptionProfileDto->name);
        $house->setDescription($consumptionProfileDto->description);
        $this->consumptionProfileRepository->save($house);
    }

    public function delete(User $user, int $id): void
    {
        $this->consumptionProfileRepository->delete($user, $id);
    }

    public function activate(User $user, int $houseId, int $id): void
    {
        // TODO: Implement activate() method.
    }
}
