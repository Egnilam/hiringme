<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Query\WishlistMemberBasket;

use Domain\Wishlist\Request\Query\WishlistMemberBasket\GetWishlistMemberBasketRequest;
use Domain\Wishlist\Response\WishlistMemberBasketResponse;

interface GetWishlistMemberBasketInterface
{
    public function execute(GetWishlistMemberBasketRequest $request): WishlistMemberBasketResponse;
}
