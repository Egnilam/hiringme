<?php

declare(strict_types=1);

namespace App\Application\View\Wishlist;

use App\Application\View\DeleteFormView;
use App\Application\View\LinkView;
use App\Application\View\ViewInterface;
use App\Application\View\Wishlist\WishlistItem\WishlistItemView;

readonly class WishlistView implements ViewInterface
{
    /**
     * @param array<WishlistItemView> $wishlistItemViews
     * @param array<string> $wishlistGroups
     */
    public function __construct(
        private string $name,
        private bool $owner,
        private string $visibility,
        private array $wishlistItemViews,
        private array $wishlistGroups,
        private LinkView $actionShowWishlist,
        private LinkView $actionUpdate,
        private DeleteFormView $actionDelete,
        private LinkView $actionAddWishlistItem,
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

    public function getVisibility(): string
    {
        return $this->visibility;
    }

    public function getActionShowWishlist(): LinkView
    {
        return $this->actionShowWishlist;
    }

    /**
     * @return array<WishlistItemView>
     */
    public function getWishlistItemViews(): array
    {
        return $this->wishlistItemViews;
    }

    /**
     * @return array<string>
     */
    public function getWishlistGroups(): array
    {
        return $this->wishlistGroups;
    }

    public function getActionUpdate(): LinkView
    {
        return $this->actionUpdate;
    }

    public function getActionDelete(): DeleteFormView
    {
        return $this->actionDelete;
    }

    public function getActionAddWishlistItem(): LinkView
    {
        return $this->actionAddWishlistItem;
    }

    public function countWishlistItems(): int
    {
        return count($this->wishlistItemViews);
    }

    public function countWishlistGroups(): int
    {
        return count($this->wishlistGroups);
    }
}
