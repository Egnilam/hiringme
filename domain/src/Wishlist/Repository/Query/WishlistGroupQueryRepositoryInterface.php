<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Request\WishlistGroup\GetListWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;

interface WishlistGroupQueryRepositoryInterface
{
    /**
     * @return array<WishlistGroupResponse>
     */
    public function getList(GetListWishlistGroupRequest $request): array;
}
