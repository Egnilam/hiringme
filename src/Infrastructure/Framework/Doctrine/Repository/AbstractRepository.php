<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository;

use App\Infrastructure\Framework\Doctrine\StorePersistEntityService;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractRepository
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected StorePersistEntityService $storePersistEntityService,
    ) {
    }
}
