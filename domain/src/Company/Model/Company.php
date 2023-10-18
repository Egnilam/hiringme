<?php

declare(strict_types=1);

namespace Domain\Company\Model;

final class Company
{
    public function __construct(
        private string $name,
        private string $companySize,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCompanySize(): string
    {
        return $this->companySize;
    }
}
