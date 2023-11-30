<?php

declare(strict_types=1);

namespace App\Application\View\Wishlist;

use App\Application\View\ViewInterface;
use App\Application\View\Wishlist\WishlistItem\WishlistItemView;

class WishlistView implements ViewInterface
{
    /**
     * @param array<WishlistItemView> $wishlistItemViews
     */
    public function __construct(
        private string $name,
        private bool $owner,
        private array $wishlistItemViews,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }

    /**
     * @return WishlistItemView[]
     */
    public function getWishlistItemViews(): array
    {
        return $this->wishlistItemViews;
    }
}
