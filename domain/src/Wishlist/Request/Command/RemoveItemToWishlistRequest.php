<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command;

final readonly class RemoveItemToWishlistRequest
{
    public function __construct(
        private string $wishlistId,
        private string $wishlistItemId,
    ) {

    }

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function getWishlistItemId(): string
    {
        return $this->wishlistItemId;
    }
}
