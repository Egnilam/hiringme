<?php

declare(strict_types=1);

namespace App\Action\Command\Company;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Company\Port\Command\RegisterCompanyInterface;
use Domain\Company\Port\Command\RegisterCompanyUserInterface;
use Domain\Company\Request\RegisterCompanyRequest;

final readonly class RegisterCompanyHandler implements CommandHandlerInterface
{
    public function __construct(private RegisterCompanyInterface $registerCompany, private RegisterCompanyUserInterface $registerCompanyUser)
    {

    }

    public function __invoke(RegisterCompanyCommand $registerCompanyCommand): void
    {

        dump('is dispatch');
        $this->registerCompany->execute($this->transformToRegisterCompanyRequest($registerCompanyCommand));

        $this->registerCompanyUser->execute();
    }

    private function transformToRegisterCompanyRequest(RegisterCompanyCommand $registerCompanyCommand): RegisterCompanyRequest
    {
        return new RegisterCompanyRequest(
            $registerCompanyCommand->getName(),
            'size'
        );
    }
}
