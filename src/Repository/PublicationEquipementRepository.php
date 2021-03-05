<?php

namespace App\Repository;

use App\Entity\PublicationEquipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PublicationEquipement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublicationEquipement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublicationEquipement[]    findAll()
 * @method PublicationEquipement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicationEquipementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PublicationEquipement::class);
    }

    // /**
    //  * @return PublicationEquipement[] Returns an array of PublicationEquipement objects
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
    public function findOneBySomeField($value): ?PublicationEquipement
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
