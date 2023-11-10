<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup;

use Domain\Wishlist\Request\Command\WishlistGroup\UpdateWishlistGroupRequest;

interface UpdateWishlistGroupInterface
{
    public function execute(UpdateWishlistGroupRequest $request): void;
}
