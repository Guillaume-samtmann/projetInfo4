<?php

namespace App\Repository;

use App\Entity\InformationsAnnimaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationsAnnimaux>
 *
 * @method InformationsAnnimaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationsAnnimaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationsAnnimaux[]    findAll()
 * @method InformationsAnnimaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationsAnnimauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationsAnnimaux::class);
    }

    //    /**
    //     * @return InformationsAnnimaux[] Returns an array of InformationsAnnimaux objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?InformationsAnnimaux
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
