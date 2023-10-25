<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Query\WishlistGroup;

use Domain\Wishlist\Request\WishlistGroup\GetListWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;

interface GetWishlistGroupInterface
{
    /**
     * @return array<WishlistGroupResponse>
     */
    public function execute(GetListWishlistGroupRequest $request): array;
}
