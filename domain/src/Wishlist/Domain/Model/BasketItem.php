<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;

final class BasketItem
{
    public function __construct(
        private string           $wishlistItemId,
        private WishlistMemberId $wishlistMemberId,
        private ?WishlistGroupId $wishlistGroupId,
        private bool             $memberVisible,
        private bool $canBeShared
    ) {

    }

    public function getWishlistItemId(): string
    {
        return $this->wishlistItemId;
    }

    public function getWishlistMemberId(): WishlistMemberId
    {
        return $this->wishlistMemberId;
    }

    public function getWishlistGroupId(): ?WishlistGroupId
    {
        return $this->wishlistGroupId;
    }

    public function isMemberVisible(): bool
    {
        return $this->memberVisible;
    }

    public function isCanBeShared(): bool
    {
        return $this->canBeShared;
    }
}
