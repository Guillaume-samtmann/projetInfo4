<?php

namespace App\Repository;

use App\Entity\DecouvrirSurPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DecouvrirSurPlace>
 *
 * @method DecouvrirSurPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method DecouvrirSurPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method DecouvrirSurPlace[]    findAll()
 * @method DecouvrirSurPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecouvrirSurPlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DecouvrirSurPlace::class);
    }

    //    /**
    //     * @return DecouvrirSurPlace[] Returns an array of DecouvrirSurPlace objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DecouvrirSurPlace
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
