<?php

// src/Service/PaginationService.php

namespace App\Service;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginationService
{
    private int $defaultLimit;

    public function __construct(int $defaultLimit = 10)
    {
        $this->defaultLimit = $defaultLimit;
    }

    public function paginate(Query $query, int $page = 1, ?int $limit = null): array
    {
        $limit = $limit ?? $this->defaultLimit;
        $page = max(1, $page);

        $query->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);
        $paginator = new Paginator($query);

        $totalItems = count($paginator);
        $totalPages = (int) ceil($totalItems / $limit);

        return [
            'items' => iterator_to_array($paginator),
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
            'limit' => $limit,
        ];
    }
}
