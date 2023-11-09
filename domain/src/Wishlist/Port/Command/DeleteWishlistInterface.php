<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Request\Command\DeleteWishlistRequest;

interface DeleteWishlistInterface
{
    public function execute(DeleteWishlistRequest $request): void;
}
