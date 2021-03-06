<?php

namespace App\Repository;

use App\Entity\Chocolaterie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chocolaterie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chocolaterie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chocolaterie[]    findAll()
 * @method Chocolaterie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChocolaterieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chocolaterie::class);
    }

    // /**
    //  * @return Chocolaterie[] Returns an array of Chocolaterie objects
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
    public function findOneBySomeField($value): ?Chocolaterie
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
