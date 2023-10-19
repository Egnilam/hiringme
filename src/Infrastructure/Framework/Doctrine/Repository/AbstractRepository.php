<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractRepository
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {
    }
}
