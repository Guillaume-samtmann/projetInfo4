<?php

namespace App\Repository;

use App\Entity\MotCles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MotCles>
 *
 * @method MotCles|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotCles|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotCles[]    findAll()
 * @method MotCles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotClesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotCles::class);
    }

    //    /**
    //     * @return MotCles[] Returns an array of MotCles objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MotCles
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
