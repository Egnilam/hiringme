<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember;

final readonly class AddWishlistGroupMemberRequest
{
    public function __construct(
        private string $wishlistGroupId,
        private string $pseudonym,
        private ?string $email = null,
        private bool $owner = false,
    ) {

    }

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }
}
