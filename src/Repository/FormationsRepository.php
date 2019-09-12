<?php

namespace App\Repository;

use App\Entity\Formations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Formations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formations[]    findAll()
 * @method Formations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formations::class);
    }

    /**
     * @param $idMe
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findDataRelationById($idMe): array
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = 'SELECT * FROM formations where formations.resume_me_id = :idme';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idme' => $idMe));
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Formations[] Returns an array of Formations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formations
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
