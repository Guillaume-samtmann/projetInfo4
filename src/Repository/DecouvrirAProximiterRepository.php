<?php

namespace App\Repository;

use App\Entity\DecouvrirAProximiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DecouvrirAProximiter>
 *
 * @method DecouvrirAProximiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method DecouvrirAProximiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method DecouvrirAProximiter[]    findAll()
 * @method DecouvrirAProximiter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecouvrirAProximiterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DecouvrirAProximiter::class);
    }

    //    /**
    //     * @return DecouvrirAProximiter[] Returns an array of DecouvrirAProximiter objects
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

    //    public function findOneBySomeField($value): ?DecouvrirAProximiter
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
