<?php

declare(strict_types=1);

namespace Domain\Common\Domain\Exception;

class NotFoundException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Not found value');
    }

    public function __toString(): string
    {
        return sprintf('%s : %d : %s', self::class, $this->code, $this->message);
    }
}
