<?php

namespace App\Repository;

use App\Entity\PricingBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PricingBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method PricingBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method PricingBlock[]    findAll()
 * @method PricingBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PricingBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PricingBlock::class);
    }

    // /**
    //  * @return PricingBlock[] Returns an array of PricingBlock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PricingBlock
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getBlockPricingDetails($status)
    {
        $connection = $this->_em->getConnection();
        $sql = 'SELECT p.*
                FROM pricing_block AS p 
                WHERE p.status = :status
                ORDER BY p.position ASC';

        $statment = $connection->prepare($sql);
        $result = $statment->executeQuery([
            'status' => $status
        ]);

        return $result->fetchAllAssociative();
    }
}
