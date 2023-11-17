<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\DataMapper\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;

abstract class WishlistGroupMemberDataMapper
{
    public static function fromDomain(
        WishlistGroupMember $wishlistGroupMember,
        WishlistGroupEntity $wishlistGroupEntity,
        WishlistMemberEntity $wishlistMemberEntity,
        ?WishlistGroupMemberEntity $wishlistGroupMemberEntity = null
    ): WishlistGroupMemberEntity {
        $wishlistGroupMemberEntity = $wishlistGroupMemberEntity ?? new WishlistGroupMemberEntity();
        $wishlistGroupMemberEntity
            ->setStringUuid($wishlistGroupMember->getId())
            ->setWishlistMember($wishlistMemberEntity)
            ->setWishlistGroup($wishlistGroupEntity)
            ->setPseudonym($wishlistGroupMember->getPseudonym())
            ->setOwner($wishlistGroupMember->isOwner());

        return $wishlistGroupMemberEntity;
    }
}
