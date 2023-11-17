<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;

interface WishlistQueryRepositoryInterface
{
    public function get(GetWishlistRequest $request): WishlistResponse;

    /**
     * @return array<WishlistResponse>
     */
    public function getList(GetListWishlistRequest $request): array;
}
