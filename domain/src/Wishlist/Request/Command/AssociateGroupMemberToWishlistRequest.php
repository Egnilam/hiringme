<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command;

final readonly class AssociateGroupMemberToWishlistRequest
{
    public function __construct(
        private string $wishlistId,
        private string $wishlistGroupId,
    ) {

    }

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }
}
