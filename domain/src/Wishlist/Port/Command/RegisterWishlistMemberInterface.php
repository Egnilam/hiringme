<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Request\RegisterWishlistMemberRequest;

interface RegisterWishlistMemberInterface
{
    public function execute(RegisterWishlistMemberRequest $request): void;
}
