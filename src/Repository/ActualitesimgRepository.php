<?php

namespace App\Repository;

use App\Entity\Actualitesimg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actualitesimg|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actualitesimg|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actualitesimg[]    findAll()
 * @method Actualitesimg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualitesimgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actualitesimg::class);
    }

    // /**
    //  * @return Actualitesimg[] Returns an array of Actualitesimg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Actualitesimg
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
