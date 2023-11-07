<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup;

use Domain\Wishlist\Request\Command\WishlistGroup\RemoveMemberToWishlistGroupRequest;

interface RemoveMemberToWishlistGroupInterface
{
    public function execute(RemoveMemberToWishlistGroupRequest $request): void;
}
