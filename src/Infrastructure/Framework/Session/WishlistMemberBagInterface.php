<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Session;

interface WishlistMemberBagInterface
{
    public function getWishlistMemberId(): string;

    public function setWishlistMemberId(string $wishlistMemberId): void;
}
