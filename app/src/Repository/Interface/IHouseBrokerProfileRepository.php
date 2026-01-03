<?php

namespace App\Repository\Interface;

use App\Entity\BrokerProfile;
use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\HouseBrokerProfile;
use App\Entity\User;

interface IHouseBrokerProfileRepository
{
    public function switchProfile(User $user, House $house, BrokerProfile $profile): void;
    public function save(User $user, HouseBrokerProfile $profile, bool $flush = true): void;
    public function getCurrentProfile(User $user,  House $house): ?HouseBrokerProfile;

    public function getHouseCountForBrokerProfile(User $user, BrokerProfile $profile): int;

}
