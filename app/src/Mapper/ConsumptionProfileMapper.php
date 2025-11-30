<?php

namespace App\Mapper;

use App\Dto\ConsumptionProfile\ConsumptionProfileDto;
use App\Dto\ConsumptionProfile\CreateConsumptionProfileDto;
use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\User;

class ConsumptionProfileMapper
{
    public function toDto(ConsumptionProfile $model): ConsumptionProfileDto
    {
        $dto = new ConsumptionProfileDto();
        $dto->id = $model->getId();
        $dto->name = $model->getName();
        $dto->description = $model->getDescription();
        $dto->consumptionIndex = $model->getConsumptionIndex();
        $dto->type = $model->getType();
        $dto->profileDay = $model->getProfileDay();
        $dto->profileWeek = $model->getProfileWeek();
        $dto->profileMonth = $model->getProfileMonth();
        $dto->profileYear = $model->getProfileYear();

        return $dto;
    }

    public function toEntity(CreateConsumptionProfileDto|ConsumptionProfileDto $dto, ?House $house = null, ?User $user = null): ConsumptionProfile
    {
        $model = new ConsumptionProfile();
        $model->setName($dto->name);
        $model->setDescription($dto->description);
        $model->setType($dto->type);
        $model->setConsumptionIndex($dto->consumptionIndex);
        $model->setProfileDay($dto->profileDay);
        $model->setProfileWeek($dto->profileWeek);
        $model->setProfileMonth($dto->profileMonth);
        $model->setProfileYear($dto->profileYear);
        $model->setUser($user);
        $model->setHouse($house);
        return $model;
    }
}
