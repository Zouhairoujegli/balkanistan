<?php

namespace App\Repository;

use App\Entity\Parti;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Parti|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parti|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parti[]    findAll()
 * @method Parti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parti::class);
    }

    public function moyenneAge($id)
    {
        return $this->createQueryBuilder('p')
                    ->join("p.politiciens","a")
                    ->select('avg(a.age)')
                    ->where("p.id = :id")
                    ->setParameter("id",$id)
                    ->getQuery()
                    ->getResult();
    }

    public function nombre($id,$sexe)
    {
        return $this->createQueryBuilder('p')
                    ->join("p.politiciens","a")
                    ->select('count(a)')
                    ->where("p.id = :id")
                    ->andwhere("a.sexe = :sexe")
                    ->setParameter("id",$id)
                    ->setParameter("sexe",$sexe)
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return Parti[] Returns an array of Parti objects
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
    public function findOneBySomeField($value): ?Parti
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
