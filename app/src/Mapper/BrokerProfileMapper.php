<?php

namespace App\Mapper;

use App\Dto\BrokerProfile\BrokerProfileDto;
use App\Dto\BrokerProfile\CreateBrokerProfileDto;
use App\Entity\BrokerProfile;
use App\Entity\User;

class BrokerProfileMapper
{
    public function toDto(BrokerProfile $model): BrokerProfileDto
    {
        $dto = new BrokerProfileDto();
        $dto->id = $model->getId();
        $dto->name = $model->getName();
        $dto->description = $model->getDescription();
        $dto->purchaseProfileDay = $model->getPurchaseProfileDay();
        $dto->purchaseProfileWeek = $model->getPurchaseProfileWeek();
        $dto->purchaseProfileMonth = $model->getPurchaseProfileMonth();
        $dto->purchaseProfileYear = $model->getPurchaseProfileYear();
        $dto->saleProfileDay = $model->getSaleProfileDay();
        $dto->saleProfileWeek = $model->getSaleProfileWeek();
        $dto->saleProfileMonth = $model->getSaleProfileMonth();
        $dto->saleProfileYear = $model->getSaleProfileYear();
        return $dto;
    }

    public function toEntity(CreateBrokerProfileDto|BrokerProfileDto $dto, ?User $user = null): BrokerProfile
    {
        $model = new BrokerProfile();

        $model->setName($dto->name);
        $model->setDescription($dto->description);
        $model->setPurchaseProfileDay($dto->purchaseProfileDay);
        $model->setPurchaseProfileWeek($dto->purchaseProfileWeek);
        $model->setPurchaseProfileMonth($dto->purchaseProfileMonth);
        $model->setPurchaseProfileYear($dto->purchaseProfileYear);
        $model->setSaleProfileDay($dto->saleProfileDay);
        $model->setSaleProfileWeek($dto->saleProfileWeek);
        $model->setSaleProfileMonth($dto->saleProfileMonth);
        $model->setSaleProfileYear($dto->saleProfileYear);
        $model->setUser($user);
        return $model;
    }

}
