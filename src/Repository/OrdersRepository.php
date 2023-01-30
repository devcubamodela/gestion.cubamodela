<?php

namespace App\Repository;

use App\Entity\Orders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Orders>
 *
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Orders::class);
        $this->entityManagerInterface=$entityManagerInterface;
    }

    public function save(Orders $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Orders $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function RegisterOrders(
    $orderId,
    $parent_id,
    $number,
    $order_key,
    $created_via,
    $version,
    $status,
    $currency,
    $date_created,
    $date_modified,
    $discount_total,
    $discount_tax,
    $shipping_total,
    $shipping_tax,
    $cart_tax,
    $total,
    $prices_include_tax,
    $customer_id,
    $customer_ip_address,
    $customer_user_agent,
    $customer_note,
    $billing_first_name,
    $billing_last_name,
    $billing_address_1,
    $billing_email,
    $billing_phone,
    $shipping_first_name,
    $shipping_last_name,
    $shipping_address_1,
    $payment_method,
    $payment_method_title,
    $date_paid){
        
        $order= new Orders();
        $order
        ->setOrderId($orderId)
        ->setParentId($parent_id)
        ->setNumber($number)
        ->setOrderKey($order_key)
        ->setCreatedVia($created_via)
        ->setVersion($version)
        ->setStatus($status)
        ->setCurrency($currency)
        ->setDateCreated($date_created)
        ->setDateModified($date_modified)
        ->setDiscountTotal($discount_total)
        ->setDiscountTax($discount_tax)
        ->setShippingTotal($shipping_total)
        ->setShippingTax($shipping_tax)
        ->setCartTax($cart_tax)
        ->setTotal($total)
        ->setPricesIncludeTax($prices_include_tax)
        ->setCustomerId($customer_id)
        ->setCustomerIpAddress($customer_ip_address)
        ->setCustomerUserAgent($customer_user_agent)
        ->setCustomerNote($customer_note)
        ->setBillingFirstName($billing_first_name)
        ->setBillingLastName($billing_last_name)
        ->setBillingAddress1($billing_address_1)
        ->setBillingEmail($billing_email)
        ->setBillingPhone($billing_phone)
        ->setShippingFirstName($shipping_first_name)
        ->setShippingLastName($shipping_last_name)
        ->setShippingAddress1($shipping_address_1)
        ->setPaymentMethod($payment_method)
        ->setPaymentMethodTitle($payment_method_title)
        ->setDatePaid($date_paid);
        $this->entityManagerInterface->persist($order);
        $this->entityManagerInterface->flush();
        
    }

//    /**
//     * @return Orders[] Returns an array of Orders objects
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

//    public function findOneBySomeField($value): ?Orders
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
