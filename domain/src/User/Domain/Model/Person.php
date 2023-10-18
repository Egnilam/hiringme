<?php

declare(strict_types=1);

namespace Domain\User\Domain\Model;

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
    public function __construct(string $firstName, string $lastName, ?\DateTimeImmutable $birthDate)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setBirthDate($birthDate);
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
    private function setFirstName(string $firstName): void
    {
        $firstName = rtrim($firstName);
        $this->checkNameFormat($firstName, 'firstName');
        $this->firstName = mb_strtoupper($firstName);
    }

    /**
     * @throws \Exception
     */
    private function setLastName(string $lastName): void
    {
        $lastName = rtrim($lastName);
        $this->checkNameFormat($lastName, 'lastName');
        $this->lastName = mb_strtoupper($lastName);
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

    /**
     * @throws \Exception
     */
    private function checkNameFormat(string $name, string $property): void
    {
        $pattern = '/^[a-zA-ZÀ-ÖØ-öø-ÿ-]{3,50}$/';

        if(!preg_match($pattern, $name)) {
            throw new \Exception(sprintf('Invalid property : %s', $property));
        }
    }
}
