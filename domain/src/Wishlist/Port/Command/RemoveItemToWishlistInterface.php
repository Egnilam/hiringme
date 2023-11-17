<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Request\Command\RemoveItemToWishlistRequest;

interface RemoveItemToWishlistInterface
{
    public function execute(RemoveItemToWishlistRequest $request): void;
}
