<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Log;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Log|null find($id, $lockMode = null, $lockVersion = null)
 * @method Log|null findOneBy(array $criteria, array $orderBy = null)
 * @method Log[]    findAll()
 * @method Log[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Log::class);
    }


    /**
    * @return Log[] Returns an array of Log objects
    */
    public function findLastLog($logtype)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.topic = '.$logtype)
            ->orderBy('l.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * [findOlderLogs description]
     * @param  [type] $logtype [description]
     * @return Query           [description]
     */
    public function findOlderLogs($logtype) : Query
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.topic = '.$logtype)
            ->setFirstResult(1)
            //->orderBy('l.id', 'DESC')
            ->setMaxResults(5)
            ->orderBy('l.date', 'DESC')
            ->getQuery()
        ;
    }

    /**
    * @return Log[] Returns an array of Log objects
    */
    public function findAllLogs($logtype)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.topic = '.$logtype)
            ->orderBy('l.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Log[] Returns an array of Log objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Log
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
