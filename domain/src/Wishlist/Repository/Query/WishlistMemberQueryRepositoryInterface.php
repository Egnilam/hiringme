<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Domain\Model\WishlistMember;
use Domain\Wishlist\Request\WishlistMember\GetWishlistMemberRequest;

interface WishlistMemberQueryRepositoryInterface
{
    public function get(GetWishlistMemberRequest $request): WishlistMember;
}
