<?php

namespace App\Repository;

use App\Entity\Vehicules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicules|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicules|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicules[]    findAll()
 * @method Vehicules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculesRepository extends ServiceEntityRepository
{
    private $environment;

    public function __construct(ManagerRegistry $registry)
    {
        $this->environment = $_ENV['APP_ENV'];
        parent::__construct($registry, Vehicules::class);
    }

    // /**
    //  * @return Vehicules[] Returns an array of Vehicules objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vehicules
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function selectRandom()
    {
        if ($this->environment === 'dev') {
            return $this->selectRandomMysql();
        } else {
            return $this->selectRandomNonMysql();
        }
    }

    private function selectRandomMysql()
    {
        return $this->createQueryBuilder('v')
            ->addSelect('RAND() as HIDDEN rand')
            ->where('v.isDisplayed = true')
            ->orderBy('rand')
            ->setMaxResults(6)
            ->getQuery()
            // ->getSQL()
            ->getResult()
        ;
    }

    private function selectRandomNonMysql()
    {
        return $this->createQueryBuilder('v')
            // ->addSelect('RAND() as HIDDEN rand')     # RAND()  not working in SQLite
            ->where('v.isDisplayed = true')
            // ->orderBy('rand')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }
}
