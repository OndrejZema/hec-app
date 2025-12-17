<?php

namespace App\Repository;

use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\HouseConsumptionProfile;
use App\Entity\User;
use App\Repository\Interface\IHouseConsumptionProfileRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HouseConsumptionProfile>
 */
class HouseConsumptionProfileRepository extends ServiceEntityRepository implements IHouseConsumptionProfileRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseConsumptionProfile::class);
    }

    //    /**
    //     * @return HouseConsumptionProfile[] Returns an array of HouseConsumptionProfile objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('h.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?HouseConsumptionProfile
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function selectProfile(User $user, House $house, ConsumptionProfile $profile): void
    {
        // TODO: Implement selectProfile() method.
    }

    public function getCurrentProfile(User $user, House $house): ConsumptionProfile
    {
        // TODO: Implement getCurrentProfile() method.
    }
}
