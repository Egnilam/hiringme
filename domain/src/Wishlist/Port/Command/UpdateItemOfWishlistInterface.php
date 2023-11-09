<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Request\Command\UpdateItemOfWishlistRequest;

interface UpdateItemOfWishlistInterface
{
    public function execute(UpdateItemOfWishlistRequest $request): void;
}
