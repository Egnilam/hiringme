<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query\WishlistGroup;

final readonly class GetListWishlistGroupRequest
{
    public function __construct(
        private ?string $wishlistMemberId = null,
        private ?bool $owner = null,
        private ?bool $active = null,
    ) {

    }

    public function getWishlistMemberId(): ?string
    {
        return $this->wishlistMemberId;
    }

    public function isOwner(): ?bool
    {
        return $this->owner;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }
}
