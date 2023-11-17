<?php

declare(strict_types=1);

namespace Domain\Common\Domain\Exception;

class EmailFormatException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Invalid email format');
    }

    public function __toString(): string
    {
        return sprintf('%s : %d : %s', self::class, $this->code, $this->message);
    }
}
