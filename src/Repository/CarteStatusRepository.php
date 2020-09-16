<?php

namespace App\Repository;

use App\Entity\CarteStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteStatus[]    findAll()
 * @method CarteStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteStatus::class);
    }

    // /**
    //  * @return CarteStatus[] Returns an array of CarteStatus objects
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
    public function findOneBySomeField($value): ?CarteStatus
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
