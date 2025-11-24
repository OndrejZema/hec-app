<?php

namespace App\Repository;

use App\Dto\House\HouseDto;
use App\Entity\House;
use App\Entity\User;
use App\Repository\Interface\IHouseRepository;
use App\Trait\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<House>
 */
class HouseRepository extends ServiceEntityRepository implements IHouseRepository
{
    use Paginator;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, House::class);
    }

    public function getById(User $user, int $id): ?House
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.user = :userId')
            ->andWhere('h.id = :id')
            ->setParameter('userId', $user->getId())
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAll(User $user, int $page, int $perPage): array
    {
        $qb = $this->createQueryBuilder('h')
            ->andWhere('h.user = :userId')
            ->setParameter('userId', $user->getId());
        list($paginator, $pagination) = $this->paginate($qb, $page, $perPage);

        return [iterator_to_array($paginator), $pagination];
    }

    public function getForUser(User $user): array
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.user = :userId')
            ->setParameter('userId', $user->getId())
            ->getQuery()->getResult();
    }
    public function getCurrentForUser(User $user): ?House {
        return
    }

    public function save(House $house, bool $flush = true): void
    {
        $this->getEntityManager()->persist($house);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(User $user, int $id, bool $flush = true): void
    {
        $house = $this->findOneBy(['user' => $user, 'id' => $id]);
        if ($house !== null) {
            $this->getEntityManager()->remove($house);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
    }
}
