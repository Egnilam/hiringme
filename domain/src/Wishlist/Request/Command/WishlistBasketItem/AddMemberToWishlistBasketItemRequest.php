<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistBasketItem;

final readonly class AddMemberToWishlistBasketItemRequest
{
    public function __construct(
        private string  $wishlistMemberId,
        private string  $wishlistId,
        private string  $wishlistItemId,
        private ?string $wishlistGroupId,
        private bool    $visibleName,
        private bool $canBeShared
    ) {

    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function getWishlistItemId(): string
    {
        return $this->wishlistItemId;
    }

    public function getWishlistGroupId(): ?string
    {
        return $this->wishlistGroupId;
    }

    public function isVisibleName(): bool
    {
        return $this->visibleName;
    }

    public function isCanBeShared(): bool
    {
        return $this->canBeShared;
    }
}
