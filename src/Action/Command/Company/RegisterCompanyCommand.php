<?php

declare(strict_types=1);

namespace App\Action\Command\Company;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class RegisterCompanyCommand implements CommandInterface
{
    public function __construct(
        private string $name
    ) {

    }

    public function getName(): string
    {
        return $this->name;
    }
}
