<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Request\Command\UpdateWishlistRequest;

interface UpdateWishlistInterface
{
    public function execute(UpdateWishlistRequest $request): void;
}
