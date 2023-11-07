<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistGroup;

final readonly class RemoveMemberToWishlistGroupRequest
{
    public function __construct(
        private string $claimantId,
        private string $wishlistGroupId,
        private string $wishlistGroupMemberId,
    ) {

    }

    public function getClaimantId(): string
    {
        return $this->claimantId;
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
