<?php

declare(strict_types=1);

namespace Domain\Wishlist\Port\Command;

use Domain\Wishlist\Request\Command\AssociateGroupMemberToWishlistRequest;

interface AssociateGroupMemberToWishlistInterface
{
    public function execute(AssociateGroupMemberToWishlistRequest $request): void;
}
