<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Query\WishlistGroup;

use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;

interface GetWishlistGroupInterface
{
    public function execute(GetWishlistGroupRequest $request): WishlistGroupResponse;
}
