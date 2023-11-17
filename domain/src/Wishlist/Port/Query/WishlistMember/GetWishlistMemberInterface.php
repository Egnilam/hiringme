<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Query\WishlistMember;

use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;

interface GetWishlistMemberInterface
{
    public function execute(GetWishlistMemberRequest $request): WishlistMemberResponse;
}
