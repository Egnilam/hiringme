<?php

declare(strict_types=1);

namespace Domain\Common\Domain\Exception;

class NameFormatException extends \Exception
{
    public function __construct(private string $property)
    {
        parent::__construct('Invalid name format', 422);
    }

    public function __toString(): string
    {
        return sprintf('%s : %d : %s - %s', self::class, $this->code, $this->property, $this->message);
    }
}
