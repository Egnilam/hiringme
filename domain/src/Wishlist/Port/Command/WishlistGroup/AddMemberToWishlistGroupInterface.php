<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup;

use Domain\Wishlist\Request\Command\WishlistGroup\AddMemberToWishlistGroupRequest;

interface AddMemberToWishlistGroupInterface
{
    public function execute(AddMemberToWishlistGroupRequest $request): string;
}
