<?php

namespace App\Repository;

use App\Entity\Economia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Economia>
 *
 * @method Economia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Economia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Economia[]    findAll()
 * @method Economia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EconomiaRepository extends ServiceEntityRepository
{

    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Economia::class);
        $this->entityManagerInterface=$entityManagerInterface;
    }

    public function RegisterOrderToPay(
        $orderid,
        $productid,
    ) {

        $orderToPay = new Economia();
        $orderToPay
            ->setIdOrden($orderid)
            ->setIdProducto($productid);



        $this->entityManagerInterface->persist($orderToPay);
        $this->entityManagerInterface->flush();
    }

    //    /**
    //     * @return Economia[] Returns an array of Economia objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Economia
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
