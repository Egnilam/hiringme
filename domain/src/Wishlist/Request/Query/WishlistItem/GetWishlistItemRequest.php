<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query\WishlistItem;

final readonly class GetWishlistItemRequest
{
    public function __construct(
        private string $id,
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }
}
