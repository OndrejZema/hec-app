<?php

namespace App\Repository\Interface;

use App\Entity\House;
use App\Entity\User;

interface IHouseRepository
{
    /**
     * @param User $user
     * @return array<House>
     */
    public function findByUser(User $user): array;

}
