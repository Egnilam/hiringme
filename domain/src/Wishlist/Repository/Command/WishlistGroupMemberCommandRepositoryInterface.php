<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Command;

use Domain\Wishlist\Domain\Model\WishlistGroupMember;

interface WishlistGroupMemberCommandRepositoryInterface
{
    public function create(WishlistGroupMember $wishlistGroupMember): string;

    public function delete(string $id): void;
}
