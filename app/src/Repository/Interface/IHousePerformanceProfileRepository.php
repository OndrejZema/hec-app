<?php

namespace App\Repository\Interface;

use App\Entity\House;
use App\Entity\PerformanceProfile;
use App\Entity\User;

interface IHousePerformanceProfileRepository
{
    public function switchProfile(User $user, House $house, PerformanceProfile $profile): void;
    public function getCurrentProfileId(User $user, House $house): ?int;
}
