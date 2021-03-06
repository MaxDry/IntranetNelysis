<?php

namespace App\Repository;

use App\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Member::class);
    }

    /**
     * @return Members[] Returns an array of Members objects
     * @param Status $status status du membre(test,valide)
     */
    public function getMembersTestByStatus($status)
    {
        $query = $this->createQueryBuilder('member')
            ->andWhere('member.status = :status')
            ->orderBy('member.firstName', 'ASC')
            ->setParameter(':status', $status)
            ->getQuery();
        return $query->getResult();
    }

    /**
     * @return Members[] Returns an array of Members objects
     */
    public function getMembersWithLineUp()
    {
        $query = $this->createQueryBuilder('m')
            ->andWhere('m.lineUp != :lineUp')
            ->setParameter(':lineUp', null)
            ->getQuery();
        return $query->execute();
    }

    // /**
    //  * @return Member[] Returns an array of Member objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Member
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
