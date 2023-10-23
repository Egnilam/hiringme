<?php

declare(strict_types=1);

namespace Domain\User\Domain\Exception;

use Domain\Common\Domain\Exception\DomainException;

class UserRoleException extends DomainException
{
    public const INVALID_ROLE_NAME = 'Invalid user role name';
    public const AT_LEAST_ONE_ROLE = 'Should be at least one user role';

    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function __toString(): string
    {
        return sprintf('%s : %d : %s', self::class, $this->code, $this->message);
    }
}
