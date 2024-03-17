<?php

namespace App\Repository;

use App\Entity\InformationsHorraireArv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationsHorraireArv>
 *
 * @method InformationsHorraireArv|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationsHorraireArv|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationsHorraireArv[]    findAll()
 * @method InformationsHorraireArv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationsHorraireArvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationsHorraireArv::class);
    }

    //    /**
    //     * @return InformationsHorraireArv[] Returns an array of InformationsHorraireArv objects
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

    //    public function findOneBySomeField($value): ?InformationsHorraireArv
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
