<?php

namespace App\Mapper;

use App\Dto\House\CreateHouseDto;
use App\Dto\House\HouseDto;
use App\Dto\House\UpdateHouseDto;
use App\Entity\House;
use App\Entity\User;

class HouseMapper
{
    public function toDto(House $house): HouseDto
    {
        $dto = new HouseDto();
        $dto->id = $house->getId();
        $dto->name = $house->getName();
        $dto->description = $house->getDescription();
        return $dto;
    }

    public function toEntity(CreateHouseDto|HouseDto $dto, ?User $user = null): House{
        $house = new House();
        $house->setName($dto->name);
        $house->setDescription($dto->description);
        if($user){
            $house->setUser($user);
        }
        return $house;
    }
}
