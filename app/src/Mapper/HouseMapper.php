<?php

namespace App\Mapper;

use App\Dto\House\CreateHouseDto;
use App\Dto\House\HouseDto;
use App\Dto\House\UpdateHouseDto;
use App\Entity\House;
use App\Entity\User;

class HouseMapper
{
    public function toDto(House $model): HouseDto
    {
        $dto = new HouseDto();
        $dto->id = $model->getId();
        $dto->name = $model->getName();
        $dto->description = $model->getDescription();
        return $dto;
    }

    public function toEntity(CreateHouseDto|HouseDto $dto, ?User $user = null): House
    {
        $model = new House();
        $model->setName($dto->name);
        $model->setDescription($dto->description);
        if ($user) {
            $model->setUser($user);
        }
        return $model;
    }
}
