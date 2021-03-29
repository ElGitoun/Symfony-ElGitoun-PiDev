<?php

namespace App\Repository;

use App\Entity\PublicationEquipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
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
    /** metier partie client */
    public function findallvisible()
    {
        return $this->findvisibleQuery()
            ->getQuery()
        ;
    }
    public function findallbyuser(){
        return $this->createQueryBuilder('p')
            ->where('p.user=2')
            ->getQuery()
            ->getResult()
        ;

    }
    public function tridesc(){
        return $this->findvisibleQuery()
        ->orderBy('p.price' ,'DESC')
        ->getQuery()
        ->getResult();
    }
    public function triasc(){
        return $this->findvisibleQuery()
        ->orderBy('p.price' ,'ASC')
        ->getQuery()
        ->getResult();
    }
    public function findlatest(){
        return $this->findvisibleQuery()
        ->orderBy('p.created_at' ,'DESC')
        ->getQuery()
        ->getResult();
    }
    public function findoldest(){
        return $this->findvisibleQuery()
        ->orderBy('p.created_at' ,'ASC')
        ->getQuery()
        ->getResult();
    }
    public function findtente(){
        return $this->findvisibleQuery()
        ->where('p.categorie=1' )
        ->getQuery()
        ->getResult();
    }
    public function findvetements(){
        return $this->findvisibleQuery()
        ->where('p.categorie=3' )
        ->getQuery()
        ->getResult();
    }
    public function findsacados(){
        return $this->findvisibleQuery()
        ->where('p.categorie=2' )
        ->getQuery()
        ->getResult();
    }
    public function findsacdecouchage(){
        return $this->findvisibleQuery()
        ->where('p.categorie=5' )
        ->getQuery()
        ->getResult();
    }
    public function findautre(){
        return $this->findvisibleQuery()
        ->where('p.categorie=4' )
        ->getQuery()
        ->getResult();
    }
    public function findvisibleQuery(){
        return $this->createQueryBuilder('p')
        ->where('p.visible=false');
    }


/*          metier de partie  admin  */
    public function adtridesc(){
        return $this->createQueryBuilder('p')
        ->orderBy('p.price' ,'DESC')
        ->getQuery()
        ->getResult();
    }
    public function adtriasc(){
        return $this->createQueryBuilder('p')
        ->orderBy('p.price' ,'ASC')
        ->getQuery()
        ->getResult();
    }
    public function adfindlatest(){
        return $this->createQueryBuilder('p')
        ->orderBy('p.created_at' ,'DESC')
        ->getQuery()
        ->getResult();
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
