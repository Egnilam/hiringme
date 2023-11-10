<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Command;

use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\Model\WishlistItem;
use Domain\Wishlist\Domain\ValueObject\WishlistId;

interface WishlistCommandRepositoryInterface
{
    public function create(Wishlist $wishlist): WishlistId;

    public function update(Wishlist $wishlist): void;

    public function delete(WishlistId $id): void;

    public function addItem(WishlistItem $wishlistItem): string;

    public function updateItem(WishlistItem $wishlistItem): void;

    public function removeItem(string $wishlistItemId): void;
}
