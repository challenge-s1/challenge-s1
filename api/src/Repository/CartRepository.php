<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function save(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

     /**
    * @return Cart[] Returns an array of Cart objects
    */
    public function findByUserId($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.client = :val')
            ->setParameter('val', $id)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getAmountMasterClassByUserId($id): ?String
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.client = :val')
            ->setParameter('val', $id)
            ->join('c.masterClass', 'm')
            ->select('SUM(c.quantity * m.price) as amount')
            ->andWhere('m.id IS NOT NULL')
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }

    public function getAmountPastrieByUserId($id): ?String
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.client = :val')
            ->setParameter('val', $id)
            ->join('c.cake', 'p')
            ->select('SUM(c.quantity * p.price) as amount')
            ->andWhere('p.id IS NOT NULL')
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }

    public function getNbInCartByMasterClass($masterClass): ?int
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.masterClass = :val')
            ->setParameter('val', $masterClass)
            ->select('SUM(c.quantity) as nb')
            ->getQuery()
            ->getSingleScalarResult();
        ;
    }

    public function drainCartForUser($idUser): void
    {
        $this->createQueryBuilder('c')
        ->delete()
        ->where('c.client = :idUser')
        ->setParameter('idUser', $idUser)
        ->getQuery()
        ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Cart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
