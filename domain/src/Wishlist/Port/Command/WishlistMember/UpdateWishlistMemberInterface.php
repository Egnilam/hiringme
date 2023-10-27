<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistMember;

use Domain\Wishlist\Request\WishlistMember\UpdateWishlistMemberRequest;

interface UpdateWishlistMemberInterface
{
    public function execute(UpdateWishlistMemberRequest $request): string;
}
