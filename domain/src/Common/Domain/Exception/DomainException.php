<?php

declare(strict_types=1);

namespace Domain\Common\Domain\Exception;

class DomainException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(protected $message)
    {
        parent::__construct($this->message, 422);
    }

    public function __toString(): string
    {
        return sprintf('%s : %d : %s', self::class, $this->code, $this->message);
    }
}
