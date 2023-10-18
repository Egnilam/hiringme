<?php

declare(strict_types=1);

namespace Domain\User\Domain\Model;

use Domain\User\Domain\Enum\UserRoleEnum;
use Domain\User\Domain\Exception\EmailException;
use Domain\User\Domain\Exception\UserRoleException;

class User
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
     * @throws EmailException|UserRoleException
     * @throws \Exception
     */
    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        array $roles,
        ?\DateTimeImmutable $birthDate = null,
        ?string $token = null,
        bool $active = true,
    ) {
        $this->person = new Person($firstName, $lastName, $birthDate);
        $this->setEmail($email);
        $this->setRoles($roles);
        $this->id = $id;
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
     * @throws EmailException
     */
    private function setEmail(string $email): void
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if(!preg_match($pattern, $email)) {
            throw new EmailException();
        }

        $this->email = $email;
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
