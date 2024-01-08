<?php

namespace App\Repository;

use App\Entity\Almacen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @extends ServiceEntityRepository<Almacen>
 *
 * @method Almacen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Almacen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Almacen[]    findAll()
 * @method Almacen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlmacenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Almacen::class);
        $this->entityManagerInterface=$entityManagerInterface;
    }

    public function RegisterAlmacen(
        $nombre,
        $direccion,
    ) {

        $newAlmacen = new Almacen();
        $newAlmacen
            ->setNombre($nombre)
            ->setDireccion($direccion);



        $this->entityManagerInterface->persist($orderToPay);
        $this->entityManagerInterface->flush();
    }

//    /**
//     * @return Almacen[] Returns an array of Almacen objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Almacen
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
