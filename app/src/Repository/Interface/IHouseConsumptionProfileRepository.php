<?php

namespace App\Repository\Interface;

use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\User;

interface IHouseConsumptionProfileRepository
{
    public function switchProfile(User $user, House $house, ConsumptionProfile $profile): void;
    public function getCurrentProfileId(User $user,  House $house): ?int;
}
