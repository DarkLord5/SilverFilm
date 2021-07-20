<?php

namespace App\Repository;

use App\Entity\ChildHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChildHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChildHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChildHistory[]    findAll()
 * @method ChildHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChildHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChildHistory::class);
    }

    // /**
    //  * @return ChildHistory[] Returns an array of ChildHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChildHistory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
