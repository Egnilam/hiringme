<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Request\Query\WishlistItem\GetWishlistItemRequest;
use Domain\Wishlist\Response\WishlistItemResponse;

interface WishlistItemQueryRepositoryInterface
{
    public function get(GetWishlistItemRequest $request): WishlistItemResponse;
}
