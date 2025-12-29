<?php

namespace App\Repository;

use App\Entity\BrokerProfile;
use App\Entity\House;
use App\Entity\HouseBrokerProfile;
use App\Entity\User;
use App\Repository\Interface\IHouseBrokerProfileRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @extends ServiceEntityRepository<HouseBrokerProfile>
 */
class HouseBrokerProfileRepository extends ServiceEntityRepository implements IHouseBrokerProfileRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseBrokerProfile::class);
    }


    public function switchProfile(User $user, House $house, BrokerProfile $profile): void
    {
        $currentProfile = new HouseBrokerProfile();
        $currentProfile->setUser($user);
        $currentProfile->setHouse($house);
        $currentProfile->setBrokerProfile($profile);
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
                ->select('IDENTITY(cp.brokerProfile)')
                ->orderBy('cp.createdAt', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (Throwable $ex) {
            return null;
        }
    }

}
