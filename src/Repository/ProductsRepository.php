<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\PreDec;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Products>
 *
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManagerInterface )
    {
        parent::__construct($registry, Products::class);
        $this->entityManagerInterface=$entityManagerInterface;
       
    }

    public function add(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function ProductRegister( 
                $id,
                $name,
                $sku,
                $date_created,
                $slug,
                $date_modified_gmt,
                $date_created_gmt,
                $date_modified,
                $type,
                $status,
                $featured,
                $catalog_visibility,
                $description ,
                $short_description,
                $price,
                $regular_price ,
                $date_on_sale_from ,
                $date_on_sale_from_gmt,
                $date_on_sale_to,
                $date_on_sale_to_gmt,
                $on_sale,
                $total_sales,
                $stock_quantity,
                $stock_status,
                $backorders,
                $backorders_allowed)
    {
        $newProduct = new Products();
        $newProduct
            ->setIdProduct($id)
            ->setname($name)
            ->Setsku($sku)
            ->setDateCreated($date_created)
            ->setSlug($slug)
            ->setDateModifiedGmt($date_modified_gmt)
            ->setDateCreatedGmt($date_created_gmt)
            ->setDateModified($date_modified)
            ->setDateModifiedGmt($date_modified_gmt)
            ->settype($type)
            ->setStatus($status)
            ->setFeatured($featured)
            ->setCatalogVisibility($catalog_visibility)
            ->setDescription($description)
            ->setShortDescription($short_description)
            ->setPrice($price)
            ->setRegularPrice($regular_price)
            ->setDateOnSaleFrom($date_on_sale_from)
            ->setDateOnSaleFromGmt($date_on_sale_from_gmt)
            ->setDateOnSaleTo($date_on_sale_to)
            ->setDateOnSaleToGmt($date_on_sale_to_gmt)
            ->setOnSale($on_sale)
            ->setTotalSales($total_sales)
            ->setStockQuantity($stock_quantity)
            ->setStockStatus($stock_status)
            ->setBackorders($backorders)
            ->setBackordersAllowed($backorders_allowed);
        $this->entityManagerInterface->persist($newProduct);
        $this->entityManagerInterface->flush();
    }

//    /**
//     * @return Products[] Returns an array of Products objects
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

//    public function findOneBySomeField($value): ?Products
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
