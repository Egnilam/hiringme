<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\DataMapper\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use Domain\Wishlist\Domain\Model\WishlistItem;

final class WishlistItemDataMapper
{
    public static function fromDomain(
        WishlistItem $wishlistItem,
        WishlistEntity $wishlistEntity,
        WishlistItemEntity $wishlistItemEntity = null,
    ): WishlistItemEntity {
        $wishlistItemEntity = $wishlistItemEntity ?? new WishlistItemEntity();
        $wishlistItemEntity
            ->setStringUuid($wishlistItem->getId())
            ->setWishlist($wishlistEntity)
            ->setLabel($wishlistItem->getLabel())
            ->setLink($wishlistItem->getLink()?->get())
            ->setDescription($wishlistItem->getDescription())
            ->setPriority($wishlistItem->getPriority()?->value)
            ->setPrice($wishlistItem->getPrice()?->get());

        return $wishlistItemEntity;
    }
}
