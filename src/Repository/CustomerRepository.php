<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Customer>
 *
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository

{
    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Customer::class);
        $this->entityManagerInterface=$entityManagerInterface;
    }

    public function save(Customer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Customer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function RegisterCustomers(
        $id_customer,
        
        $date_created,
        $date_created_gmt,
        $date_modified,
        $date_modified_gmt,
        $email,
        $first_name,
        $last_name,
        $role,
        $username,
        $billing_firs_name,
        $billing_last_name,
        $billing_company,
        $billing_address_1,
        $billing_address_2,
        $billing_city,
        $billing_state,
        $billing_postcode,
        $billing_country,
        $billing_email,
        $billing_phone,
        $shipping_firs_name,
        $shipping_last_name,
        $shipping_company,
        $shipping_address_1,
        $shipping_address_2,
        $shipping_city,
        $shipping_state,
        $shipping_postcode,
        $shipping_country,
        $is_paying_customer,
       
        ){
            
            $customer= new Customer();
            $customer
            ->setIdCustomer($id_customer)
            ->setDateCreated($date_created)
            ->setDateCreatedGmt($date_created_gmt)
            ->setDateModified($date_modified)
            ->setDateModifiedGmt($date_modified_gmt)
            ->setEmail($email)
            ->setFirstName($first_name)
            ->setLastName($last_name)
            ->setRole($role)
            ->setUsername($username)
            ->setBillingFirsName($billing_firs_name)
            ->setBillingLastName($billing_last_name)
            ->setBillingCompany($billing_company)
            ->setBillingAddress1($billing_address_1)
            ->setBillingAddress2($billing_address_2)
            ->setBillingCity($billing_city)
            ->setBillingState($billing_state)
            ->setBillingPostcode($billing_postcode)
            ->setBillingCountry($billing_country)
            ->setBillingEmail($billing_email)
            ->setBillingPhone($billing_phone)
            ->setShippingFirsName($shipping_firs_name)
            ->setShippingLastName($shipping_last_name)
            ->setShippingCompany($shipping_company)
            ->setShippingAddress1($shipping_address_1)
            ->setShippingAddress2($shipping_address_2)
            ->setShippingCity($shipping_city)
            ->setShippingState($shipping_state)
            ->setShippingPostcode($shipping_postcode)
            ->setShippingCountry($shipping_country)
            ->setIsPayingCustomer($is_paying_customer);
            
            
    
            $this->entityManagerInterface->persist($customer);
            $this->entityManagerInterface->flush();
            
        }

//    /**
//     * @return Customer[] Returns an array of Customer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Customer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
