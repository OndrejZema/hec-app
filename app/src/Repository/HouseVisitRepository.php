<?php

namespace App\Repository;

use App\Entity\HouseVisit;
use App\Entity\User;
use App\Repository\Interface\IHouseVisitRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @extends ServiceEntityRepository<HouseVisit>
 */
class HouseVisitRepository extends ServiceEntityRepository implements IHouseVisitRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseVisit::class);
    }


    public function save(HouseVisit $houseVisit, bool $flush = true): void
    {
        $this->getEntityManager()->persist($houseVisit);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getSelectedId(User $user): ?int
    {
        try {
            return $this->createQueryBuilder('h')
                ->andWhere('h.user = :userId')
                ->setParameter('userId', $user->getId())
                ->select('IDENTITY(h.house)')
                ->orderBy('h.createdAt', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (Throwable $ex) {
            return null;
        }
    }
}
