<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;

final class WishlistGroupCommandRepository extends AbstractRepository implements WishlistGroupCommandRepositoryInterface
{
    public function create(WishlistGroup $wishlistGroup): string
    {
        $wishlistGroupEntity = new WishlistGroupEntity();
        $wishlistGroupEntity
            ->setStringUuid($wishlistGroup->getId()->getId())
            ->setName($wishlistGroup->getName());

        $this->entityManager->persist($wishlistGroupEntity);

        return $wishlistGroupEntity->getStringUuid();
    }
}
