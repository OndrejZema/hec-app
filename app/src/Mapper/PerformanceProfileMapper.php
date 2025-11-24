<?php

namespace App\Mapper;

use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\PerformanceProfileDto;
use App\Entity\House;
use App\Entity\PerformanceProfile;
use App\Entity\User;

class PerformanceProfileMapper
{
    public function toDto(PerformanceProfile $model): PerformanceProfileDto
    {
        $dto = new PerformanceProfileDto();
        $dto->id = $model->getId();
        $dto->name = $model->getName();
        $dto->description = $model->getDescription();
        return $dto;
    }

    public function toEntity(CreatePerformanceProfileDto|PerformanceProfileDto $dto, House $house, ?User $user = null): PerformanceProfile{
        $model = new PerformanceProfile();
        $model->setName($dto->name);
        $model->setDescription($dto->description);
        $model->setHouse($house);
        $model->setType($dto->type);
        $model->setPerformanceIndex($dto->performanceIndex);
        $model->setProfileDay($dto->profileDay);
        $model->setProfileWeek($dto->profileWeek);
        $model->setProfileMonth($dto->profileMonth);
        $model->setProfileYear($dto->profileYear);
        if($user){
            $model->setUser($user);
        }
        return $model;
    }
}
