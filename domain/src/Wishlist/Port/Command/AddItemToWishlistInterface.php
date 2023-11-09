<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Request\Command\AddItemToWishlistRequest;

interface AddItemToWishlistInterface
{
    public function execute(AddItemToWishlistRequest $request): string;
}
