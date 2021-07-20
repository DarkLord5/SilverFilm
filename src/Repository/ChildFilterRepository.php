<?php

namespace App\Repository;

use App\Entity\ChildFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChildFilter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChildFilter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChildFilter[]    findAll()
 * @method ChildFilter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChildFilterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChildFilter::class);
    }

    // /**
    //  * @return ChildFilter[] Returns an array of ChildFilter objects
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
    public function findOneBySomeField($value): ?ChildFilter
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
