<?php

namespace App\Repository;

use App\Entity\OrangeElephant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrangeElephant>
 *
 * @method OrangeElephant|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrangeElephant|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrangeElephant[]    findAll()
 * @method OrangeElephant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrangeElephantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrangeElephant::class);
    }

    //    /**
    //     * @return OrangeElephant[] Returns an array of OrangeElephant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OrangeElephant
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
