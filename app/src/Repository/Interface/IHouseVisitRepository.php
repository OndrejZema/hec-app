<?php

namespace App\Repository\Interface;

use App\Entity\HouseVisit;
use App\Entity\User;

interface IHouseVisitRepository
{
    public function save(HouseVisit $houseVisit, bool $flush = true): void;
    public function getSelectedId(User $user): ?int;
}
