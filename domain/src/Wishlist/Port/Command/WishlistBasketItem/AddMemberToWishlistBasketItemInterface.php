<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistBasketItem;

use Domain\Wishlist\Request\Command\WishlistBasketItem\AddMemberToWishlistBasketItemRequest;

interface AddMemberToWishlistBasketItemInterface
{
    public function execute(AddMemberToWishlistBasketItemRequest $request): string;
}
