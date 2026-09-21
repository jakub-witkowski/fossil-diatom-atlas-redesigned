<?php

namespace App\Repository;

use App\Entity\RelativeAge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RelativeAge>
 */
class RelativeAgeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelativeAge::class);
    }

//    public function findByRelativeAge($relativeAge)
//    {
//        return $this->createQueryBuilder('photo')
//        ->andWhere('photo.isPublished = 1')
//        ->join('photo.taxon', 'taxon')
//        ->join('taxon.genus', 'genus')
//        ->join('taxon.species', 'species')
//        ->join('photo.relativeAge', 'relativeAge')
//        ->andWhere('relativeAge.id = :searchTerm')
//        ->setParameter('searchTerm', $relativeAge)
//        ->addOrderBy('genus.name')
//        ->addOrderBy('species.name', 'ASC')
//        ->getQuery()
//        ->getResult();
//    }

    //    /**
    //     * @return RelativeAge[] Returns an array of RelativeAge objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RelativeAge
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
