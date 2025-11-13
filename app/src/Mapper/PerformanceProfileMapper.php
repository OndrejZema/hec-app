<?php

namespace App\Mapper;

use App\Dto\PerformanceProfile\CreatePerformanceProfileDto;
use App\Dto\PerformanceProfile\PerformanceProfileDto;
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

    public function toEntity(CreatePerformanceProfileDto|PerformanceProfileDto $dto, ?User $user = null): PerformanceProfile{
        $model = new PerformanceProfile();
        $model->setName($dto->name);
        $model->setDescription($dto->description);
        if($user){
            $model->setUser($user);
        }
        return $model;
    }
}
