<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistBasketItemResponse
{
    public function __construct(
        private string $id,
        private string $wishlistItemId,
        private string $wishlistMemberId,
        private string $memberName,
        private bool $visibleName,
        private bool $canBeShared,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWishlistItemId(): string
    {
        return $this->wishlistItemId;
    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function getMemberName(): string
    {
        return $this->memberName;
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
