<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistMemberResponse
{
    public function __construct(
        private string $id,
        private ?string $userId = null,
        private ?string $email = null,
        private bool $registered = false,
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function isRegistered(): bool
    {
        return $this->registered;
    }
}
