<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request;

final readonly class RegisterWishlistMemberRequest
{
    public function __construct(
        private ?string $email = null,
        private bool $registered = false
    ) {

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
