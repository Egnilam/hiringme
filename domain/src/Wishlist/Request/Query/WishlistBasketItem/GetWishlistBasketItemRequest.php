<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query\WishlistBasketItem;

final readonly class GetWishlistBasketItemRequest
{
    public function __construct(
        private string $wishlistItemId,
        private ?string $wishlistGroupId = null
    ) {

    }

    public function getWishlistItemId(): string
    {
        return $this->wishlistItemId;
    }

    public function getWishlistGroupId(): ?string
    {
        return $this->wishlistGroupId;
    }
}
