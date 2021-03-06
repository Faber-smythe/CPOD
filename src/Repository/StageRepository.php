<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    public function findCountryStages($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.country = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    public function findCountryStagesOldFirst($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.country = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    public function findPreviousCountryStage($country, $id)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.country = :country')
            ->andWhere('s.id < :val')
            ->setParameters(array('country' => $country, 'val' => $id))
            ->orderBy('s.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    public function findNextCountryStage($country, $id)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.country = :country')
            ->setParameter('country', $country)
            ->andWhere('s.id > :val')
            ->setParameter('val', $id)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
