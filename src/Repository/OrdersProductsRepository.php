<?php

namespace App\Repository;

use App\Entity\OrdersProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<OrdersProducts>
 *
 * @method OrdersProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdersProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdersProducts[]    findAll()
 * @method OrdersProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersProductsRepository extends ServiceEntityRepository
{
    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, OrdersProducts::class);
        $this->entityManagerInterface=$entityManagerInterface;
    }

    public function save(OrdersProducts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrdersProducts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function RegisterOrdersProducts(
        $order_id,
        $product_id,
        
        ){
            
            $orderProducts= new OrdersProducts();
            $orderProducts
            ->setIdOrder($order_id)
            ->setIdProduct($product_id);
            
    
            $this->entityManagerInterface->persist($orderProducts);
            $this->entityManagerInterface->flush();
            
        }

//    /**
//     * @return OrdersProducts[] Returns an array of OrdersProducts objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrdersProducts
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
