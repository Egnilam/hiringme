<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Command;

use Domain\Wishlist\Domain\Model\WishlistMember;

interface WishlistMemberCommandRepositoryInterface
{
    public function register(WishlistMember $wishlistMember): string;
}
