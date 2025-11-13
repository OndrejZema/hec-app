<?php

namespace App\Mapper;

use App\Dto\ConsumptionProfile\ConsumptionProfileDto;
use App\Dto\ConsumptionProfile\CreateConsumptionProfileDto;
use App\Entity\ConsumptionProfile;
use App\Entity\User;

class ConsumptionProfileMapper
{
    public function toDto(ConsumptionProfile $model): ConsumptionProfileDto
    {
        $dto = new ConsumptionProfileDto();
        $dto->id = $model->getId();
        $dto->name = $model->getName();
        $dto->description = $model->getDescription();
        return $dto;
    }

    public function toEntity(CreateConsumptionProfileDto|ConsumptionProfileDto $dto, ?User $user = null): ConsumptionProfile
    {
        $model = new ConsumptionProfile();
        $model->setName($dto->name);
        $model->setDescription($dto->description);
        if ($user) {
            $model->setUser($user);
        }
        return $model;
    }
}
