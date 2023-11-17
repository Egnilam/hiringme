<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Query;

use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;

interface GetListWishlistInterface
{
    /**
     * @return array<WishlistResponse>
     */
    public function execute(GetListWishlistRequest $request): array;
}
