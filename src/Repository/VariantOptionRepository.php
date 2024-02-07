<?php

namespace App\Repository;

use App\Entity\VariantOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VariantOption>
 *
 * @method VariantOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method VariantOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method VariantOption[]    findAll()
 * @method VariantOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariantOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariantOption::class);
    }

//    /**
//     * @return VariantOption[] Returns an array of VariantOption objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VariantOption
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
