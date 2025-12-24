<?php

namespace App\Service;

use App\Dto\ConsumptionProfile\ConsumptionProfileDto;
use App\Dto\ConsumptionProfile\CreateConsumptionProfileDto;
use App\Dto\ConsumptionProfile\UpdateConsumptionProfileDto;
use App\Entity\User;
use App\Mapper\ConsumptionProfileMapper;
use App\Repository\Interface\IConsumptionProfileRepository;
use App\Repository\Interface\IHouseConsumptionProfileRepository;
use App\Repository\Interface\IHouseRepository;
use App\Repository\Interface\IHouseVisitRepository;
use App\Service\Interface\IConsumptionProfileService;

class ConsumptionProfileService implements IConsumptionProfileService
{
    public function __construct(
        protected IConsumptionProfileRepository      $consumptionProfileRepository,
        protected ConsumptionProfileMapper           $consumptionProfileMapper,
        protected IHouseRepository                   $houseRepository,
        protected IHouseVisitRepository              $houseVisitRepository,
        protected IHouseConsumptionProfileRepository $houseConsumptionProfileRepository
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
        list($consumptionProfiles, $pagination) = $this->consumptionProfileRepository->getAll($user, $houseId, $page, $perPage);
        $house = $this->houseRepository->getById($user, $houseId);
        $currentId = $this->houseConsumptionProfileRepository->getCurrentProfileId($user, $house);
        return [array_map(function ($model) use ($currentId) {
            $dto = $this->consumptionProfileMapper->toDto($model);
            $dto->isCurrent = $currentId === $dto->id;
            return $dto;
        }, $consumptionProfiles), $pagination];
    }

    public function create(User $user, CreateConsumptionProfileDto $consumptionProfileDto): void
    {
        $currentHouseId = $this->houseVisitRepository->getCurrentId($user);
        $house = $this->houseRepository->getById($user, $currentHouseId);

        $consumptionProfile = $this->consumptionProfileMapper->toEntity($consumptionProfileDto, $house, $user);

        $this->consumptionProfileRepository->save($consumptionProfile);
    }

    public function update(User $user, UpdateConsumptionProfileDto $consumptionProfileDto): void
    {
        $consumptionProfile = $this->consumptionProfileRepository->getById($user, $consumptionProfileDto->id);
        if ($consumptionProfile === null) {
            //@todo throw exception
        }
        $consumptionProfile->setName($consumptionProfileDto->name);
        $consumptionProfile->setDescription($consumptionProfileDto->description);
        $consumptionProfile->setType($consumptionProfileDto->type);
        $consumptionProfile->setConsumptionIndex($consumptionProfileDto->consumptionIndex);
        $consumptionProfile->setProfileDay($consumptionProfileDto->profileDay);
        $consumptionProfile->setProfileWeek($consumptionProfileDto->profileWeek);
        $consumptionProfile->setProfileMonth($consumptionProfileDto->profileMonth);
        $consumptionProfile->setProfileYear($consumptionProfileDto->profileYear);
        $this->consumptionProfileRepository->save($consumptionProfile);
    }

    public function delete(User $user, int $id): void
    {
        $this->consumptionProfileRepository->delete($user, $id);
    }

    public function switchProfile(User $user, int $houseId, int $id): void
    {
        $house = $this->houseRepository->getById($user, $houseId);
        $profile = $this->consumptionProfileRepository->getById($user, $id);
        $this->houseConsumptionProfileRepository->switchProfile($user, $house, $profile);
    }
}
