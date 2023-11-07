<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember;

use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;

final readonly class BuildWishlistGroupMemberRequest
{
    public function __construct(
        private WishlistGroupId $wishlistGroupId,
        private string $pseudonym,
        private ?string $email = null,
        private bool $owner = false,
    ) {

    }

    public function getWishlistGroupId(): WishlistGroupId
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
