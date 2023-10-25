<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember;

use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

interface CreateWishlistGroupMemberInterface
{
    public function execute(CreateWishlistGroupMemberRequest $request): void;
}