<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Command;

use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

interface WishlistGroupMemberCommandRepositoryInterface
{
    public function create(CreateWishlistGroupMemberRequest $request): void;
}