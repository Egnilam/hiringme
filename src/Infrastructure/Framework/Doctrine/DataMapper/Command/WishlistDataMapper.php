<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\DataMapper\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use Domain\Wishlist\Domain\Model\Wishlist;

final class WishlistDataMapper
{
    public static function fromDomain(
        Wishlist $wishlist,
        WishlistMemberEntity $wishlistMemberEntity,
        ?WishlistEntity $wishlistEntity = null
    ): WishlistEntity {
        $wishlistEntity = $wishlistEntity ?? new WishlistEntity();

        $wishlistEntity
            ->setStringUuid($wishlist->getId()->getId())
            ->setName($wishlist->getName())
            ->setWishlistMember($wishlistMemberEntity)
            ->setVisibility($wishlist->getVisibility()->value);

        return $wishlistEntity;
    }
}
