<?php

declare(strict_types=1);

namespace Domain\User\Domain\Model;

use Domain\Common\Domain\ValueObject\NameValueObject;

class Person
{
    private const MIN_AGE = 6;
    private const MAX_AGE = 110;

    private string $firstName;

    private string $lastName;

    private ?\DateTimeImmutable $birthDate;


    /**
     * @throws \Exception
     */
    public function __construct(NameValueObject $firstName, NameValueObject $lastName, ?\DateTimeImmutable $birthDate)
    {
        $this->setBirthDate($birthDate);
        $this->firstName = $firstName->get();
        $this->lastName = $lastName->get();
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    /**
     * @throws \Exception
     */
    private function setBirthDate(?\DateTimeImmutable $birthDate): void
    {
        if($birthDate === null) {
            return;
        }

        if($birthDate->diff(new \DateTimeImmutable())->y < self::MIN_AGE) {
            throw new \Exception(sprintf('To young, under %d years old.', self::MIN_AGE));
        }

        if($birthDate->diff(new \DateTimeImmutable())->y > self::MAX_AGE) {
            throw new \Exception(sprintf('To old, over %d years old.', self::MAX_AGE));
        }

        $this->birthDate = $birthDate;
    }
}
