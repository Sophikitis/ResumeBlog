<?php

namespace App\Repository;

use App\Entity\Works;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Works|null find($id, $lockMode = null, $lockVersion = null)
 * @method Works|null findOneBy(array $criteria, array $orderBy = null)
 * @method Works[]    findAll()
 * @method Works[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Works::class);
    }


    /**
     * @param $idMe
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findDataRelationById($idMe)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = 'SELECT * FROM works where works.resume_me_id = :idme';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idme' => $idMe));
        return $stmt->fetchAll();
    }


    /*
    public function findOneBySomeField($value): ?Works
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
