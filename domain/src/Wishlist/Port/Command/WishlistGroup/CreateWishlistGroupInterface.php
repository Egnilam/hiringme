<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup;

use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Request\Command\WishlistGroup\CreateWishlistGroupRequest;

interface CreateWishlistGroupInterface
{
    public function execute(CreateWishlistGroupRequest $request): WishlistGroupId;
}
