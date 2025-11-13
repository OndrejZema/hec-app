<?php

namespace App\Repository;

use App\Entity\ConsumptionProfile;
use App\Entity\House;
use App\Entity\User;
use App\Repository\Interface\IConsumptionProfileRepository;
use App\Trait\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConsumptionProfile>
 */
class ConsumptionProfileRepository extends ServiceEntityRepository implements IConsumptionProfileRepository
{
    use Paginator;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsumptionProfile::class);
    }

    public function getById(User $user, int $id): ?ConsumptionProfile
    {
        return $this->createQueryBuilder('pp')
            ->andWhere('pp.user = :userId')
            ->andWhere('pp.id = :id')
            ->setParameter('userId', $user->getId())
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAll(User $user, int $page, int $perPage): array
    {
        $qb = $this->createQueryBuilder('cp')
            ->andWhere('cp.user = :userId')
            ->setParameter('userId', $user->getId());
        list($paginator, $pagination) = $this->paginate($qb, $page, $perPage);

        return [iterator_to_array($paginator), $pagination];

    }

    public function save(ConsumptionProfile $consumptionProfile, bool $flush = true): void
    {
        $this->getEntityManager()->persist($consumptionProfile);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(User $user, int $id, bool $flush = true): void
    {
        $consumptionProfile = $this->findOneBy(['user' => $user, 'id' => $id]);
        if($consumptionProfile !== null){
            $this->getEntityManager()->remove($consumptionProfile);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
    }
}
