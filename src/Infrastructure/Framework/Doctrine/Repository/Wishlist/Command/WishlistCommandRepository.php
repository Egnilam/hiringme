<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\DataMapper\Command\WishlistItemDataMapper;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\Model\WishlistItem;
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
            ->setWishlistMember($wishlistMemberEntity)
            ->setVisibility($wishlist->getVisibility()->value);

        $this->entityManager->persist($wishlistEntity);

        return $wishlist->getId();
    }

    public function addItem(WishlistItem $wishlistItem): string
    {
        $wishlistItemEntity = $this->buildWishlistItemEntity($wishlistItem);

        $this->entityManager->persist($wishlistItemEntity);

        return $wishlistItem->getId();
    }

    public function updateItem(WishlistItem $wishlistItem): void
    {
        $this->buildWishlistItemEntity(
            $wishlistItem,
            $this->getWishlistItemEntity($wishlistItem->getId())
        );
    }

    public function removeItem(string $wishlistItemId): void
    {
        $wishlistItemEntity = $this->getWishlistItemEntity($wishlistItemId);

        $this->entityManager->remove($wishlistItemEntity);
    }

    private function buildWishlistItemEntity(WishlistItem $wishlistItem, WishlistItemEntity $wishlistItemEntity = null): WishlistItemEntity
    {
        $wishlistEntity = $this->entityManager->getRepository(WishlistEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlistItem->getWishlistId()->getId())]);

        if(!$wishlistEntity) {
            throw new NotFoundException();
        }

        return WishlistItemDataMapper::fromDomain(
            $wishlistItem,
            $wishlistEntity,
            $wishlistItemEntity
        );
    }

    private function getWishlistItemEntity(string $wishlistItemId): WishlistItemEntity
    {
        $wishlistItemEntity = $this->entityManager->getRepository(WishlistItemEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlistItemId)]);

        if(!$wishlistItemEntity) {
            throw new NotFoundException();
        }

        return $wishlistItemEntity;
    }
}
