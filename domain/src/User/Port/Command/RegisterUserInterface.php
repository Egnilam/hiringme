<?php

declare(strict_types=1);

namespace Domain\User\Port\Command;

use Domain\User\Request\RegisterUserRequest;

interface RegisterUserInterface
{
    public function execute(RegisterUserRequest $request): void;
}
