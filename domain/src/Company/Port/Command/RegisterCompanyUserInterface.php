<?php

declare(strict_types=1);

namespace Domain\Company\Port\Command;

interface RegisterCompanyUserInterface
{
    public function execute(): void;
}