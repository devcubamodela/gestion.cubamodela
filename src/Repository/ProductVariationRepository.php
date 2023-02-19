<?php

namespace App\Repository;

use App\Entity\ProductVariation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<ProductVariation>
 *
 * @method ProductVariation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductVariation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductVariation[]    findAll()
 * @method ProductVariation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductVariationRepository extends ServiceEntityRepository
{
    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, ProductVariation::class);
        $this->entityManagerInterface=$entityManagerInterface;
    }

    public function save(ProductVariation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductVariation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function productVariationRegister( 
        $id_variation,
        $date_created,
        $description,
        $sku,
        $price,
        $regular_price,
        $sale_price,
        $status,
        $stock_status,
        $id_product)
{
$newProduct = new ProductVariation();
$newProduct
    ->setIdVariation($id_variation)
    ->setDateCreated($date_created)
    ->setDescription($description)
    ->setSku($sku)
    ->setPrice($price)
    ->setRegularPrice($regular_price)
    ->setSalePrice($sale_price)
    ->setStatus($status)
    ->setStockStatus($stock_status)
    ->setIdProduct($id_product)
    ;
$this->entityManagerInterface->persist($newProduct);
$this->entityManagerInterface->flush();
}

//    /**
//     * @return ProductVariation[] Returns an array of ProductVariation objects
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

//    public function findOneBySomeField($value): ?ProductVariation
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
