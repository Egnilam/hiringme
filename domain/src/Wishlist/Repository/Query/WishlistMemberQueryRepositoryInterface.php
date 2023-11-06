<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;

interface WishlistMemberQueryRepositoryInterface
{
    public function get(GetWishlistMemberRequest $request): WishlistMemberResponse;
}
