<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class RemoveItemToWishlistCommand implements CommandInterface
{
    private string $wishlistId;

    private string $wishlistItemId;

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function setWishlistId(string $wishlistId): self
    {
        $this->wishlistId = $wishlistId;
        return $this;
    }

    public function getWishlistItemId(): string
    {
        return $this->wishlistItemId;
    }

    public function setWishlistItemId(string $wishlistItemId): self
    {
        $this->wishlistItemId = $wishlistItemId;
        return $this;
    }
}
