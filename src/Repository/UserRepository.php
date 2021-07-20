<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    
   public function findAllByRoleUSER(): array
{
  $conn = $this->getEntityManager()->getConnection();

    $sql = "
       SELECT * FROM `user` WHERE JSON_CONTAINS(roles, '[\"ROLE_USER\"]')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAll();

    // to get just one result:
    // $product = $query->setMaxResults(1)->getOneOrNullResult();
}
 public function findAllByRoleCHILD(): array
{
  $conn = $this->getEntityManager()->getConnection();

    $sql = "
       SELECT * FROM `user` WHERE JSON_CONTAINS(roles, '[\"ROLE_CHILD\"]')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAll();

    // to get just one result:
    // $product = $query->setMaxResults(1)->getOneOrNullResult();
}
    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
