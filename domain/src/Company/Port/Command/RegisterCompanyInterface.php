<?php

declare(strict_types=1);

namespace Domain\Company\Port\Command;

use Domain\Company\Request\RegisterCompanyRequest;

interface RegisterCompanyInterface
{
    public function execute(RegisterCompanyRequest $registerCompanyRequest): void;
}