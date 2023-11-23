<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Request\Query\WishlistBasketItem\GetWishlistBasketItemRequest;
use Domain\Wishlist\Response\WishlistBasketItemResponse;

interface WishlistBasketItemQueryRepositoryInterface
{
    /**
     * @return array<WishlistBasketItemResponse>
     */
    public function get(GetWishlistBasketItemRequest $request): array;
}
