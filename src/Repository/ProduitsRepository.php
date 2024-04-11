<?php

namespace App\Repository;

use App\Entity\Produits;
use App\Model\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\MotCles;
use App\Entity\Region;

/**
 * @extends ServiceEntityRepository<Produits>
 *
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    //    /**
    //     * @return Produits[] Returns an array of Produits objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Produits
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findByMotCle($motCle): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.motsCles', 'm')
            ->andWhere('m.nom = :motCles')
            ->setParameter('motCles', $motCle)
            ->getQuery()
            ->getResult();
    }
    public function findByRegion($region): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.region', 'r')  // Join avec la relation de la région
            ->andWhere('r.nom = :region_nom') // Comparaison avec le nom de la région
            ->setParameter('region_nom', $region)
            ->getQuery()
            ->getResult();
    }

    public function findBySearch(SearchData $searchData)
    {
        $queryBuilder = $this->createQueryBuilder('r');

        if (!empty($searchData->q)) {
            $queryBuilder
                ->andWhere('r.nom LIKE :keyword OR re.nom LIKE :keyword OR n.nom')
                ->setParameter('keyword', '%' . $searchData->q . '%');
        }

        $data = $queryBuilder->getQuery()->getResult();

        return $data;
    }

}
