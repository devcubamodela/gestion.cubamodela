<?php

namespace App\Repository;

use App\Entity\Vale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vale>
 *
 * @method Vale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vale[]    findAll()
 * @method Vale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vale::class);
    }

//    /**
//     * @return Vale[] Returns an array of Vale objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vale
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
