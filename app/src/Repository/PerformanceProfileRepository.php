<?php

namespace App\Repository;

use App\Entity\House;
use App\Entity\PerformanceProfile;
use App\Entity\User;
use App\Repository\Interface\IPerformanceProfileRepository;
use App\Trait\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PerformanceProfile>
 */
class PerformanceProfileRepository extends ServiceEntityRepository implements IPerformanceProfileRepository
{
    use Paginator;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformanceProfile::class);
    }

    public function getById(User $user, int $id): ?PerformanceProfile
    {
        return $this->createQueryBuilder('pp')
            ->andWhere('pp.user = :userId')
            ->andWhere('pp.id = :id')
            ->setParameter('userId', $user->getId())
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAll(User $user, int $houseId, int $page, int $perPage): array
    {
        $qb = $this->createQueryBuilder('pp')
            ->andWhere('pp.user = :userId')
            ->andWhere('pp.house = :houseId')
            ->setParameter('userId', $user->getId())
            ->setParameter('houseId', $houseId);
        list($paginator, $pagination) = $this->paginate($qb, $page, $perPage);

        return [iterator_to_array($paginator), $pagination];
    }

    public function save(PerformanceProfile $performanceProfile, bool $flush = true): void
    {
        $this->getEntityManager()->persist($performanceProfile);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(User $user, int $id, bool $flush = true): void
    {
        $performanceProfile = $this->findOneBy(['user' => $user, 'id' => $id]);
        if ($performanceProfile !== null) {
            $this->getEntityManager()->remove($performanceProfile);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
    }

    public function getCountForHouse(User $user, House $house): int
    {
        return (int) $this->createQueryBuilder('h')
            ->select('COUNT(h.id)')
            ->andWhere('h.user = :user')
            ->andWhere('h.house = :house')
            ->setParameter('user', $user)
            ->setParameter('house', $house)
            ->getQuery()
            ->getSingleScalarResult();
    }

}
