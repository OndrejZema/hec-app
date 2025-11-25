<?php

namespace App\Service;

use App\Entity\House;
use App\Entity\HouseVisit;
use App\Entity\User;
use App\Repository\Interface\IHouseVisitRepository;
use App\Service\Interface\IHouseVisitService;

class HouseVisitService implements IHouseVisitService
{
    public function __construct(protected IHouseVisitRepository $houseVisitRepository)
    {

    }

    public function visit(User $user, House $house): void
    {
        $houseVisit = new HouseVisit();
        $houseVisit->setUser($user);
        $houseVisit->setHouse($house);
        $this->houseVisitRepository->save($houseVisit);
    }

    public function getCurrentId(User $user): ?int
    {
        return $this->houseVisitRepository->getCurrentId($user);
    }
}
