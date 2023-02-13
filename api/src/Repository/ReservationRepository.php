<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function save(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getNbReservationByMasterClass($id): ?String
    {
        return $this->createQueryBuilder('r')
            ->select('SUM(r.nbPlaces)')
            ->andWhere('r.masterClass = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }

    //    /**
    //     * @return Reservation[] Returns an array of Reservation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    /**
     * @return Reservation[] Returns an array of Reservation objects
     */
    public function findByMasterClassField($value): array
    {
        return $this->createQueryBuilder('r')
            ->select('r.id', 'r.nbPlaces', 'r.price', 'u.email', 'm.title')
            ->innerJoin('r.userId', 'u')
            ->innerJoin('r.masterClass', 'm')
            ->andWhere('r.masterClass = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    }
}
