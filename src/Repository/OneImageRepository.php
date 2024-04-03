<?php

namespace App\Repository;

use App\Entity\OneImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OneImage>
 *
 * @method OneImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method OneImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method OneImage[]    findAll()
 * @method OneImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OneImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OneImage::class);
    }

    //    /**
    //     * @return OneImage[] Returns an array of OneImage objects
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

    //    public function findOneBySomeField($value): ?OneImage
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
