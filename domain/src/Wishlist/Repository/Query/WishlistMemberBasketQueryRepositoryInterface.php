<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Request\Query\WishlistMemberBasket\GetWishlistMemberBasketRequest;
use Domain\Wishlist\Response\WishlistMemberBasketResponse;

interface WishlistMemberBasketQueryRepositoryInterface
{
    public function get(GetWishlistMemberBasketRequest $request): WishlistMemberBasketResponse;
}
