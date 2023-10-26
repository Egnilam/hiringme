<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistMember;

use Domain\Wishlist\Request\WishlistMember\RegisterWishlistMemberRequest;

interface RegisterWishlistMemberInterface
{
    public function execute(RegisterWishlistMemberRequest $request): string;
}
