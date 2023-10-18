<?php

declare(strict_types=1);

namespace Domain\Company\Repository\Command;

use Domain\Company\Model\Company;

interface CompanyCommandRepositoryInterface
{
    public function register(Company $company): void;
}
