<?php

declare(strict_types=1);

namespace Domain\Company\UseCase\Command;

use Domain\Company\Port\Command\RegisterCompanyUserInterface;

final readonly class RegisterCompanyUserUseCase implements RegisterCompanyUserInterface
{
    public function execute(): void
    {
        dump('it\s working');
    }
}