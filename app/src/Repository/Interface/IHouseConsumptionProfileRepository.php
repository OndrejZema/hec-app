<?php

namespace App\Repository\Interface;

use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\User;

interface IHouseConsumptionProfileRepository
{
    public function selectProfile(User $user, House $house, ConsumptionProfile $profile): void;
    public function getCurrentProfile(User $user,  House $house): ConsumptionProfile;
}
