<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query\WishlistMemberBasket;

final class GetWishlistMemberBasketRequest
{
    public function __construct(
        private readonly string $wishlistMemberId
    ) {

    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }
}
