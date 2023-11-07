<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;

interface WishlistQueryRepositoryInterface
{
    /**
     * @return array<WishlistResponse>
     */
    public function get(GetListWishlistRequest $request): array;
}
