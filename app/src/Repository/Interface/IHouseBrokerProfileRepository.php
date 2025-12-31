<?php

namespace App\Repository\Interface;

use App\Entity\BrokerProfile;
use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\User;

interface IHouseBrokerProfileRepository
{
    public function switchProfile(User $user, House $house, BrokerProfile $profile): void;
    public function getCurrentProfileId(User $user,  House $house): ?int;
}
