<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember;

use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberRequest;

interface AddWishlistGroupMemberInterface
{
    public function execute(AddWishlistGroupMemberRequest $request): string;
}
