<?php

declare(strict_types=1);

namespace Domain\Common\Domain\Exception;

class EmailFormatException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid email format', 422);
    }

    public function __toString(): string
    {
        return sprintf('%s : %d : %s', self::class, $this->code, $this->message);
    }
}
