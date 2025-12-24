<?php

namespace App\Repository;

use App\Entity\House;
use App\Entity\HousePerformanceProfile;
use App\Entity\PerformanceProfile;
use App\Entity\User;
use App\Repository\Interface\IHousePerformanceProfileRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @extends ServiceEntityRepository<HousePerformanceProfile>
 */
class HousePerformanceProfileRepository extends ServiceEntityRepository implements IHousePerformanceProfileRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HousePerformanceProfile::class);
    }

    public function switchProfile(User $user, House $house, PerformanceProfile $profile): void
    {
        $currentProfile = new HousePerformanceProfile();
        $currentProfile->setUser($user);
        $currentProfile->setHouse($house);
        $currentProfile->setPerformanceProfile($profile);
        $this->getEntityManager()->persist($currentProfile);
        $this->getEntityManager()->flush();
    }

    public function getCurrentProfileId(User $user, House $house): ?int
    {
        try {
            return $this->createQueryBuilder('pp')
                ->andWhere('pp.user = :user')
                ->setParameter('user', $user)
                ->andWhere('pp.house = :house')
                ->setParameter('house', $house)
                ->select('IDENTITY(pp.performanceProfile)')
                ->orderBy('pp.createdAt', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (Throwable $ex) {
            return null;
        }
    }
}
