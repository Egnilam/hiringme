<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistMemberBasketResponse
{
    /**
     * @param array<WishlistMemberBasketItemResponse> $items
     */
    public function __construct(
        private array $items
    ) {

    }

    /**
     * @return array<WishlistMemberBasketItemResponse>
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
