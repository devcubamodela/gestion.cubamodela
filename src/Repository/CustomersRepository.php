<?php

namespace App\Repository;

use App\Entity\Customers;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Customers>
 *
 * @method Customers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customers[]    findAll()
 * @method Customers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersRepository extends ServiceEntityRepository
{
    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Customers::class);
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function save(Customers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Customers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function CustomerRegister(
        $id_costumer,
        $date_created,
        $date_created_gmt,
        $email,
        $first_name,
        $last_name,
        $role,
        $username,
        $first_name_biling,
        $last_name_biling,
        $address_1_biling,
        $company_biling,
        $address_2_biling,
        $city_biling,
        $state_biling,
        $postcode_biling,
        $country_biling,
        $email_biling,
        $phone_biling,
        $first_name_shipping,
        $last_name_shipping,
        $company_shipping,
        $address_1_shipping,
        $address_2_shipping,
        $city_shipping,
        $state_shipping,
        $postcode_shipping,
        $country_shipping,
        $is_paying_customer,
        $avatar_url
     
    ) {
        $newCustomer = new Customers();
        $newCustomer
            ->setIdCostumer($id_costumer)
            ->setDateCreated($date_created)
            ->setDateCreatedGmt($date_created_gmt)
            ->setEmail($email)
            ->setFirstName($first_name)
            ->setLastName($last_name)
            ->setRole($role)
            ->setUsername($username)
            ->setFirstNameBiling($first_name_biling)
            ->setLastNameBiling($last_name_biling)
            ->setAddress1Biling($address_1_biling)
            ->setCompanyBiling($company_biling)
            ->setAddress2Biling($address_2_biling)
            ->setCityBiling($city_biling)
            ->setStateBiling($state_biling)
            ->setPostcodeBiling($postcode_biling)
            ->setCountryBiling($country_biling)
            ->setEmailBiling($email_biling)
            ->setPhoneBiling($phone_biling)
            ->setFirstNameShipping($first_name_shipping)
            ->setLastNameShipping($last_name_shipping)
            ->setCompanyShipping($company_shipping)
            ->setAddress1Shipping($address_1_shipping)
            ->setAddress2Shipping($address_2_shipping)
            ->setCityShipping($city_shipping)
            ->setStateShipping($state_shipping)
            ->setPostcodeShipping($postcode_shipping)
            ->setCountryShipping($country_shipping)
            ->setIsPayingCustomer($is_paying_customer)
            ->setAvatarUrl($avatar_url);
        $this->entityManagerInterface->persist($newCustomer);
        $this->entityManagerInterface->flush();
    }

    //    /**
    //     * @return Customers[] Returns an array of Customers objects
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

    //    public function findOneBySomeField($value): ?Customers
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
