<?php

namespace App\Repository;

use App\Entity\BrokerProfile;
use App\Entity\User;
use App\Repository\Interface\IBrokerProfileRepository;
use App\Trait\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BrokerProfile>
 */
class BrokerProfileRepository extends ServiceEntityRepository implements IBrokerProfileRepository
{
    use Paginator;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrokerProfile::class);
    }
    public function getById(User $user, int $id): ?BrokerProfile
    {
        return $this->createQueryBuilder('bp')
            ->andWhere('bp.user = :userId')
            ->andWhere('bp.id = :id')
            ->setParameter('userId', $user->getId())
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAll(User $user, int $page, int $perPage): array
    {
        $qb = $this->createQueryBuilder('bp')
            ->andWhere('bp.user = :userId')
            ->setParameter('userId', $user->getId());

        list($paginator, $pagination) = $this->paginate($qb, $page, $perPage);

        return [iterator_to_array($paginator), $pagination];

    }

    public function save(BrokerProfile $brokerProfile, bool $flush = true): void
    {
        $this->getEntityManager()->persist($brokerProfile);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(User $user, int $id, bool $flush = true): void
    {
        $brokerProfile = $this->findOneBy(['user' => $user, 'id' => $id]);
        if ($brokerProfile !== null) {
            $this->getEntityManager()->remove($brokerProfile);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
    }
}
