<?php

namespace App\Service;

use App\Dto\BrokerProfile\BrokerProfileDto;
use App\Dto\BrokerProfile\CreateBrokerProfileDto;
use App\Dto\BrokerProfile\UpdateBrokerProfileDto;
use App\Entity\User;
use App\Mapper\BrokerProfileMapper;
use App\Repository\Interface\IBrokerProfileRepository;
use App\Service\Interface\IBrokerProfileService;

class BrokerProfileService implements IBrokerProfileService
{
    public function __construct(
        protected IBrokerProfileRepository $brokerProfileRepository,
        protected BrokerProfileMapper      $brokerProfileMapper
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
        $dtos = [];

        foreach ($items as $item) {
            $dtos[] = $this->brokerProfileMapper->toDto($item);
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
}
