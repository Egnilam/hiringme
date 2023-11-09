<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Query\WishlistItem;

use Domain\Wishlist\Request\Query\WishlistItem\GetWishlistItemRequest;
use Domain\Wishlist\Response\WishlistItemResponse;

interface GetWishlistItemInterface
{
    public function execute(GetWishlistItemRequest $request): WishlistItemResponse;
}
