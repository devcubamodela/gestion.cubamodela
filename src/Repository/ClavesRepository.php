<?php

namespace App\Repository;

use App\Entity\Claves;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<Claves>
 *
 * @method Claves|null find($id, $lockMode = null, $lockVersion = null)
 * @method Claves|null findOneBy(array $criteria, array $orderBy = null)
 * @method Claves[]    findAll()
 * @method Claves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClavesRepository extends ServiceEntityRepository
{
    private $entityManagerInterface;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Claves::class);
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function save(Claves $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Claves $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function RegisterKeys(
        $ck,
        $cs,

    ) {

        $keys = new Claves();
        $keys
            ->setCk($ck)
            ->setCs($cs);


        $this->entityManagerInterface->persist($keys);
        $this->entityManagerInterface->flush();
    }

    //    /**
    //     * @return Claves[] Returns an array of Claves objects
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

    //    public function findOneBySomeField($value): ?Claves
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
