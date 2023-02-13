<?php

namespace App\Repository;

use App\Entity\ProviderProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;




/**
 * @extends ServiceEntityRepository<ProviderProduct>
 *
 * @method ProviderProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProviderProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProviderProduct[]    findAll()
 * @method ProviderProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderProductRepository extends ServiceEntityRepository
{
    private $entityManagerInterface;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, ProviderProduct::class);
        $this->entityManagerInterface=$entityManagerInterface;
    }

    public function save(ProviderProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProviderProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function provid_product_register(
        $nomb_proveedor,
        $id_product,
        $costo
    ) {
        $newProv_product = new ProviderProduct();
        $newProv_product
            ->setNombProvider($nomb_proveedor)
            ->setIdProduct($id_product)
            ->setCost($costo);
        $this->entityManagerInterface->persist($newProv_product);
        $this->entityManagerInterface->flush();
    }

//    /**
//     * @return ProviderProduct[] Returns an array of ProviderProduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProviderProduct
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
