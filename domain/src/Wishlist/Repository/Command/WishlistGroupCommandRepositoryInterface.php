<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Command;

use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;

interface WishlistGroupCommandRepositoryInterface
{
    public function create(WishlistGroup $wishlistGroup): WishlistGroupId;

    public function addMember(WishlistGroupMember $wishlistGroupMember): string;

    public function removeMember(string $wishlistGroupMemberId): void;
}
