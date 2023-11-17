<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\ValueObject\Email;

final class WishlistMember
{
    private string $id;

    private ?string $email;

    private ?string $userId;

    private bool $registered;


    /**
     * @throws DomainException
     */
    public function __construct(string $id, ?Email $email, ?string $userId, bool $registered)
    {
        if($registered && $userId === null) {
            throw new DomainException('Can\'t find registered user');
        }
        $this->id = $id;
        $this->email = $email?->get();
        $this->userId = $userId;
        $this->registered = $registered;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function isRegistered(): bool
    {
        return $this->registered;
    }
}
