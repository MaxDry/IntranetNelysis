<?php

namespace App\Repository;

use App\Entity\Ranks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ranks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ranks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ranks[]    findAll()
 * @method Ranks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RanksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ranks::class);
    }

    // /**
    //  * @return Ranks[] Returns an array of Ranks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ranks
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
