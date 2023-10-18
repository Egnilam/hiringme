<?php

declare(strict_types=1);

namespace Domain\User\Repository\Command;

use Domain\User\Domain\Model\User;

interface UserCommandRepositoryInterface
{
    public function register(User $user): void;
}
