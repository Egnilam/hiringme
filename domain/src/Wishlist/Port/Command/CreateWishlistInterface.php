<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Request\Command\CreateWishlistRequest;

interface CreateWishlistInterface
{
    public function execute(CreateWishlistRequest $request): WishlistId;
}
