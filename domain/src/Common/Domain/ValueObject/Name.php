<?php

declare(strict_types=1);

namespace Domain\Common\Domain\ValueObject;

use Domain\Common\Domain\Exception\NameFormatException;

final class Name
{
    public const PROPERTY_FIRSTNAME = 'firstName';
    public const PROPERTY_LASTNAME = 'lastName';

    private string $name;


    /**
     * @throws NameFormatException
     */
    public function __construct(string $name, string $property)
    {
        $name = rtrim($name);
        $pattern = '/^[a-zA-ZÀ-ÖØ-öø-ÿ-]{3,50}$/';

        if(!preg_match($pattern, $name)) {
            throw new NameFormatException($property);
        }

        $this->name = mb_strtoupper($name);
    }

    public function get(): string
    {
        return $this->name;
    }
}
