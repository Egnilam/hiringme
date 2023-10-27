<?php

declare(strict_types=1);

namespace Domain\User\Domain\Model;

use Domain\Common\Domain\ValueObject\EmailValueObject;
use Domain\Common\Domain\ValueObject\NameValueObject;
use Domain\User\Domain\Enum\UserRoleEnum;
use Domain\User\Domain\Exception\UserRoleException;

final class User
{
    private string $id;

    private Person $person;

    private string $email;

    private string $password;

    /**
     * @var array<string>
     */
    private array $roles;

    private ?string $token;

    public bool $active;

    /**
     * @param array<string> $roles
     * @throws UserRoleException
     * @throws \Exception
     */
    public function __construct(
        string $id,
        NameValueObject $firstName,
        NameValueObject $lastName,
        EmailValueObject $email,
        string $password,
        array $roles,
        ?\DateTimeImmutable $birthDate = null,
        ?string $token = null,
        bool $active = true,
    ) {
        $this->person = new Person($firstName, $lastName, $birthDate);
        $this->setRoles($roles);
        $this->id = $id;
        $this->email = $email->get();
        $this->password = $password;
        $this->token = $token;
        $this->active = $active;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array<string>
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param array<string> $roles
     * @throws UserRoleException
     */
    private function setRoles(array $roles): void
    {
        if(count($roles) === 0) {
            throw new UserRoleException(UserRoleException::AT_LEAST_ONE_ROLE);
        }

        foreach ($roles as $role) {
            if(UserRoleEnum::tryFrom($role) === null) {
                throw new UserRoleException(UserRoleException::INVALID_ROLE_NAME);
            }
        }

        $this->roles = $roles;
    }
}
