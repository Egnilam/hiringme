<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Command;

use Domain\Wishlist\Domain\Model\WishlistGroup;

interface WishlistGroupCommandRepositoryInterface
{
    public function create(WishlistGroup $wishlistGroup): void;
}
