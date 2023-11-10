<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\DataMapper\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use Domain\Wishlist\Domain\Model\WishlistGroup;

final class WishlistGroupDataMapper
{
    public static function fromDomain(
        WishlistGroup $wishlistGroup,
        ?WishlistGroupEntity $wishlistGroupEntity = null,
    ): WishlistGroupEntity {
        $wishlistGroupEntity = $wishlistGroupEntity ?? new WishlistGroupEntity();
        $wishlistGroupEntity
            ->setStringUuid($wishlistGroup->getId()->getId())
            ->setName($wishlistGroup->getName());

        return $wishlistGroupEntity;
    }
}
