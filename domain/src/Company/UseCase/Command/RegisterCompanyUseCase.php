<?php

declare(strict_types=1);

namespace Domain\Company\UseCase\Command;



use Domain\Company\Model\Company;
use Domain\Company\Port\Command\RegisterCompanyInterface;
use Domain\Company\Repository\Command\CompanyCommandRepositoryInterface;
use Domain\Company\Request\RegisterCompanyRequest;

final readonly class RegisterCompanyUseCase implements RegisterCompanyInterface
{
    public function __construct(private CompanyCommandRepositoryInterface $companyCommandRepository){

    }

    public function execute(RegisterCompanyRequest $registerCompanyRequest): void
    {
        dump($registerCompanyRequest);

        $this->companyCommandRepository->register(new Company($registerCompanyRequest->getName(), $registerCompanyRequest->getCompanySize()));
    }
}