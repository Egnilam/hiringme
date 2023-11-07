<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;

final class WishlistCommandRepository extends AbstractRepository implements WishlistCommandRepositoryInterface
{
    public function create(Wishlist $wishlist): WishlistId
    {
        $wishlistMemberEntity = $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlist->getOwner()->getId())]);

        if(!$wishlistMemberEntity) {
            throw new NotFoundException();
        }

        $wishlistEntity = new WishlistEntity();
        $wishlistEntity
            ->setStringUuid($wishlist->getId()->getId())
            ->setName($wishlist->getName())
            ->setWishlistMember($wishlistMemberEntity);

        $this->entityManager->persist($wishlistEntity);

        return $wishlist->getId();
    }
}
