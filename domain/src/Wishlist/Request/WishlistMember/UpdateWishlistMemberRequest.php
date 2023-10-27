<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\WishlistMember;

final readonly class UpdateWishlistMemberRequest
{
    public function __construct(
        private string $id,
        private string $email,
        private ?string $userId = null,
        private bool $registered = false
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
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
