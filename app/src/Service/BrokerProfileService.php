<?php

namespace App\Service;

use App\Dto\BrokerProfile\BrokerProfileDto;
use App\Dto\BrokerProfile\CreateBrokerProfileDto;
use App\Dto\BrokerProfile\UpdateBrokerProfileDto;
use App\Entity\BrokerProfile;
use App\Entity\HouseBrokerProfile;
use App\Entity\User;
use App\Mapper\BrokerProfileMapper;
use App\Repository\Interface\IBrokerProfileRepository;
use App\Repository\Interface\IHouseBrokerProfileRepository;
use App\Repository\Interface\IHouseRepository;
use App\Repository\Interface\IHouseVisitRepository;
use App\Service\Interface\IBrokerProfileService;
use Exception;

class BrokerProfileService implements IBrokerProfileService
{
    public function __construct(
        protected IBrokerProfileRepository      $brokerProfileRepository,
        protected BrokerProfileMapper           $brokerProfileMapper,
        protected IHouseVisitRepository         $houseVisitRepository,
        protected IHouseRepository              $houseRepository,
        protected IHouseBrokerProfileRepository $houseBrokerProfileRepository
    )
    {
    }

    public function getById(User $user, int $id): ?BrokerProfileDto
    {
        $model = $this->brokerProfileRepository->getById($user, $id);
        return $this->brokerProfileMapper->toDto($model);
    }

    public function getAll(User $user, int $page, int $perPage): array
    {
        list($items, $pagination) = $this->brokerProfileRepository->getAll($user, $page, $perPage);
        $houseId = $this->houseVisitRepository->getCurrentId($user);
        $house = $this->houseRepository->getById($user, $houseId);
        $dtos = [];
        $currentProfile = $this->houseBrokerProfileRepository->getCurrentProfile($user, $house);
        /** @var BrokerProfile $item */
        foreach ($items as $item) {
            $dto = $this->brokerProfileMapper->toDto($item);
            $dto->isCurrent = $item->getId() === $currentProfile?->getBrokerProfile()->getId() ?? false;
            $dto->isActive = $dto->isCurrent ? $currentProfile->isActive() : false;
            $dtos[] = $dto;
        }
        return [$dtos, $pagination];
    }

    public function create(User $user, CreateBrokerProfileDto $brokerProfileDto): void
    {
        $model = $this->brokerProfileMapper->toEntity($brokerProfileDto, $user);

        $this->brokerProfileRepository->save($model);
    }

    public function update(User $user, UpdateBrokerProfileDto $brokerProfileDto): void
    {
        $brokerProfile = $this->brokerProfileRepository->getById($user, $brokerProfileDto->id);
        $brokerProfile->setName($brokerProfileDto->name);
        $brokerProfile->setDescription($brokerProfileDto->description);
        $brokerProfile->setPurchaseProfileDay($brokerProfileDto->purchaseProfileDay);
        $brokerProfile->setPurchaseProfileWeek($brokerProfileDto->purchaseProfileWeek);
        $brokerProfile->setPurchaseProfileMonth($brokerProfileDto->purchaseProfileMonth);
        $brokerProfile->setPurchaseProfileYear($brokerProfileDto->purchaseProfileYear);
        $brokerProfile->setSaleProfileDay($brokerProfileDto->saleProfileDay);
        $brokerProfile->setSaleProfileWeek($brokerProfileDto->saleProfileWeek);
        $brokerProfile->setSaleProfileMonth($brokerProfileDto->saleProfileMonth);
        $brokerProfile->setSaleProfileYear($brokerProfileDto->saleProfileYear);

        $this->brokerProfileRepository->save($brokerProfile);
    }

    public function delete(User $user, int $id): void
    {
        $this->brokerProfileRepository->delete($user, $id);
    }

    public function switchProfile(User $user, int $houseId, int $id): void
    {
        $house = $this->houseRepository->getById($user, $houseId);
        $brokerProfile = $this->brokerProfileRepository->getById($user, $id);
        $this->houseBrokerProfileRepository->switchProfile($user, $house, $brokerProfile);
    }

    public function switchState(User $user, int $houseId, int $id): void
    {
        $house = $this->houseRepository->getById($user, $houseId);
        $currentProfile = $this->houseBrokerProfileRepository->getCurrentProfile($user, $house);

        if($id !== $currentProfile->getBrokerProfile()->getId()) {
            throw new Exception("Wrong profile");
        }
        $newProfile = new HouseBrokerProfile();
        $newProfile->setUser($currentProfile->getUser());
        $newProfile->setHouse($currentProfile->getHouse());
        $newProfile->setBrokerProfile($currentProfile->getBrokerProfile());
        $newProfile->setIsActive(!$currentProfile->isActive());
        $this->houseBrokerProfileRepository->save($user, $newProfile);
    }

}
