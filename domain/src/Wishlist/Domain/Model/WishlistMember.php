<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Common\Domain\ValueObject\EmailValueObject;

final class WishlistMember
{
    private string $id;

    private ?string $email;

    private ?string $userId;

    private bool $registered;

    /**
     * @throws \Exception
     */
    public function __construct(string $id, ?EmailValueObject $email, ?string $userId, bool $registered)
    {
        if($registered && $userId === null) {
            throw new \Exception('Can\'t find registered user', 422);
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
