<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command\WishlistGroup;

use Domain\Wishlist\Request\Command\DeleteWishlistRequest;

interface DeleteWishlistGroupInterface
{
    public function execute(DeleteWishlistRequest $request): void;
}
