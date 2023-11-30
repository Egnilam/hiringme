<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistGroup;

final readonly class RemoveMemberToWishlistGroupRequest
{
    public function __construct(
        private string $wishlistGroupId,
        private string $wishlistGroupMemberId,
    ) {

    }

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }

    public function getWishlistGroupMemberId(): string
    {
        return $this->wishlistGroupMemberId;
    }
}
