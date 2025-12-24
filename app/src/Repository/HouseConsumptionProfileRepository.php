<?php

namespace App\Repository;

use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\HouseConsumptionProfile;
use App\Entity\User;
use App\Repository\Interface\IHouseConsumptionProfileRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @extends ServiceEntityRepository<HouseConsumptionProfile>
 */
class HouseConsumptionProfileRepository extends ServiceEntityRepository implements IHouseConsumptionProfileRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseConsumptionProfile::class);
    }
    public function switchProfile(User $user, House $house, ConsumptionProfile $profile): void
    {
        $currentProfile = new HouseConsumptionProfile();
        $currentProfile->setUser($user);
        $currentProfile->setHouse($house);
        $currentProfile->setConsumptionProfile($profile);
        $this->getEntityManager()->persist($currentProfile);
        $this->getEntityManager()->flush();
    }

    public function getCurrentProfileId(User $user, House $house): ?int
    {
        try {
            return $this->createQueryBuilder('cp')
                ->andWhere('cp.user = :user')
                ->setParameter('user', $user)
                ->andWhere('cp.house = :house')
                ->setParameter('house', $house)
                ->select('IDENTITY(cp.consumptionProfile)')
                ->orderBy('cp.createdAt', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (Throwable $ex) {
            return null;
        }
    }
}
