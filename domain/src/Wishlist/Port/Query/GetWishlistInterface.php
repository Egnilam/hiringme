<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Query;

use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;

interface GetWishlistInterface
{
    public function execute(GetWishlistRequest $request): WishlistResponse;
}
