<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember;

use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\RemoveWishlistGroupMemberRequest;

interface RemoveWishlistGroupMemberInterface
{
    public function execute(RemoveWishlistGroupMemberRequest $request): void;
}
