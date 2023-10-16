<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Command;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Company\Model\Company;
use Domain\Company\Repository\Command\CompanyCommandRepositoryInterface;

final readonly class CompanyCommandRepository implements CompanyCommandRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {

    }

    public function register(Company $company): void
    {
        dump($company);
    }
}