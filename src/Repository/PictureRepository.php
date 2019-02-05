<?php

namespace App\Repository;

use App\Entity\PictureSearch;
use App\Entity\Picture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Picture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture[]    findAll()
 * @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Picture::class);
    }

    // /**
    //  * @return Picture[] Returns an array of Picture objects
    //  */
    public function allSortedByCountry()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.country', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Picture[] Returns an array of Picture objects
    //  *
    public function allRecentFirst(PictureSearch $search)
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.date', 'DESC');

        if($search->getCountry()){
            $query = $query->andWhere('p.country = :country')
            ->setParameter('country', $search->getCountry());
        }

        if($search->getTags()){
            foreach($search->getTags() as $tag){
                $query = $query->andWhere("p.tag LIKE '%" . $tag . "%'");
            }
        }

        return $query->getQuery();
    }




    // /**
    //  * @return Picture[] Returns an array of Picture objects
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
    public function findOneBySomeField($value): ?Picture
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
