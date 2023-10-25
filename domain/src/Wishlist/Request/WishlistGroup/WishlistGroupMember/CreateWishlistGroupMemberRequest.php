<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember;

final readonly class CreateWishlistGroupMemberRequest
{
    public function __construct(
        private string $wishlistGroupId,
        private string $wishlistMemberId,
        private string $pseudonym,
    ) {

    }

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }
}