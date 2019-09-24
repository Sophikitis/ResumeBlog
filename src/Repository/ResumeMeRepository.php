<?php

namespace App\Repository;

use App\Entity\ResumeMe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ResumeMe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResumeMe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResumeMe[]    findAll()
 * @method ResumeMe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumeMeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResumeMe::class);
    }

    /*public function findFirst(){
        return $this->createQueryBuilder('m')
            ->getQuery()
            ->getSingleResult();
    }*/

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findFirst() {
        $qb = $this->createQueryBuilder('m');
        $qb->setMaxResults( 1 );
        $qb->orderBy('m.id', 'ASC');

        return $qb->getQuery()->getSingleResult();
    }

    // /**
    //  * @return ResumeMe[] Returns an array of ResumeMe objects
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
    public function findOneBySomeField($value): ?ResumeMe
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
