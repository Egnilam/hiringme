<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup;

use Domain\Wishlist\Request\WishlistGroup\CreateWishlistGroupRequest;

interface CreateWishlistGroupInterface
{
    public function execute(CreateWishlistGroupRequest $createWishlistGroupRequest): void;
}
