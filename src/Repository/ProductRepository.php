<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Search products by name or description.
     *
     * @return Product[]
     */
    public function searchProducts(?string $query): array
    {
        $qb = $this->createQueryBuilder('p');

        if ($query) {
            // Use wildcards to match partial queries
            $qb->andWhere('p.name LIKE :query OR p.longDescription LIKE :query')
                ->setParameter('query', '%'.$query.'%');
        }

        return $qb->getQuery()->getResult();
    }

    public function createPaginatedQuery(): Query
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC') // Adjust ordering as needed
            ->getQuery();
    }
}
