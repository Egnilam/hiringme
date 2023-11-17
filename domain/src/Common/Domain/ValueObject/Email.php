<?php

declare(strict_types=1);

namespace Domain\Common\Domain\ValueObject;

use Domain\Common\Domain\Exception\EmailFormatException;

final class Email
{
    private string $email;

    /**
     * @throws EmailFormatException
     */
    public function __construct(string $email)
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if(!preg_match($pattern, $email)) {
            throw new EmailFormatException();
        }

        $this->email = $email;
    }

    public function get(): string
    {
        return $this->email;
    }
}
