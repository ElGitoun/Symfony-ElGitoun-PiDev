<?php

namespace App\Repository;

use App\Entity\Activite;
use App\Entity\ActiviteSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activite[]    findAll()
 * @method Activite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activite::class);
    }

    // /**
    //  * @return Activite[] Returns an array of Activite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activite
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function search($term)
    {
        return $this->createQueryBuilder('Activite')
            ->andWhere('Activite.title = :tit')
            ->setParameter('tit', $term)
            ->getQuery()
            ->execute();
    }

      /**
      * @return Query
      */

    public function findAllVisibleQuery(ActiviteSearch $search) : Query
    {
     $query = $this->findVisibleQuery();
     if ($search->getMaxPrice()) {
         $query = $query
          ->andwhere('a.price <= :maxprice')
          ->setParameter('maxprice', $search->getMaxPrice()) ;
     }
     if ($search->getMinDuration()) {
        $query = $query
         ->andwhere('a.duration >= :minduration')
         ->setParameter('minduration', $search->getMinDuration()) ;
    }
     return $query->getQuery();
    }
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('a');
        
    }
}
