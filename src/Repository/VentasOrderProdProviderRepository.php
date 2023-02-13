<?php

namespace App\Repository;

use App\Entity\VentasOrderProdProvider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VentasOrderProdProvider>
 *
 * @method VentasOrderProdProvider|null find($id, $lockMode = null, $lockVersion = null)
 * @method VentasOrderProdProvider|null findOneBy(array $criteria, array $orderBy = null)
 * @method VentasOrderProdProvider[]    findAll()
 * @method VentasOrderProdProvider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VentasOrderProdProviderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VentasOrderProdProvider::class);
    }

    public function save(VentasOrderProdProvider $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VentasOrderProdProvider $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VentasOrderProdProvider[] Returns an array of VentasOrderProdProvider objects
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

//    public function findOneBySomeField($value): ?VentasOrderProdProvider
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
