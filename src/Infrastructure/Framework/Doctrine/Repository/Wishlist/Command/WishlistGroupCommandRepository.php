<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Symfony\Component\Uid\Uuid;

final class WishlistGroupCommandRepository extends AbstractRepository implements WishlistGroupCommandRepositoryInterface
{
    public function create(WishlistGroup $wishlistGroup): void
    {
        $wishlistGroupEntity = new WishlistGroupEntity();
        $wishlistGroupEntity
            ->setName($wishlistGroup->getName());
    }
}
