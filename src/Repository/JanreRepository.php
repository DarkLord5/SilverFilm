<?php

namespace App\Repository;

use App\Entity\Janre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Janre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Janre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Janre[]    findAll()
 * @method Janre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JanreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Janre::class);
    }

    // /**
    //  * @return Janre[] Returns an array of Janre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Janre
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	public function findByField($value)
    {
	return $this->createQueryBuilder('j')
			->andWhere('j.id in :val')
            ->setParameter('val', $value)
            ->getQuery()
			->getResult()
        ;
	
	}
}
