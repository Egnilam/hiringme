<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class AssociateGroupMemberToWishlistCommand implements CommandInterface
{
    private string $wishlistId;

    private string $wishlistGroupId;

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function setWishlistId(string $wishlistId): self
    {
        $this->wishlistId = $wishlistId;
        return $this;
    }

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }

    public function setWishlistGroupId(string $wishlistGroupId): self
    {
        $this->wishlistGroupId = $wishlistGroupId;
        return $this;
    }
}
