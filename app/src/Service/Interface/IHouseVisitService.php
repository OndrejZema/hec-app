<?php

namespace App\Service\Interface;

use App\Entity\House;
use App\Entity\User;

interface IHouseVisitService
{
    public function visit(User $user, House $house): void;

    public function getSelectedId(User $user): ?int;
}
