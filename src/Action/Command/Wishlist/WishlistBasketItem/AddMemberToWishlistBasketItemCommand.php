<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistBasketItem;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class AddMemberToWishlistBasketItemCommand implements CommandInterface
{
    private string $wishlistMemberId;

    private string $wishlistId;

    private string $wishlistItemId;

    private ?string $wishlistGroupId = null;

    private bool $visible;

    private bool $lock;

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function setWishlistMemberId(string $wishlistMemberId): self
    {
        $this->wishlistMemberId = $wishlistMemberId;
        return $this;
    }

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

    public function getWishlistGroupId(): ?string
    {
        return $this->wishlistGroupId;
    }

    public function setWishlistGroupId(?string $wishlistGroupId): self
    {
        $this->wishlistGroupId = $wishlistGroupId;
        return $this;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;
        return $this;
    }

    public function isLock(): bool
    {
        return $this->lock;
    }

    public function setLock(bool $lock): self
    {
        $this->lock = $lock;
        return $this;
    }
}
