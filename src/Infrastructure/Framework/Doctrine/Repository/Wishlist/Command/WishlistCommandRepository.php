<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\DataMapper\Command\WishlistDataMapper;
use App\Infrastructure\Framework\Doctrine\DataMapper\Command\WishlistItemDataMapper;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\Model\WishlistItem;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;

final class WishlistCommandRepository extends AbstractRepository implements WishlistCommandRepositoryInterface
{
    public function create(Wishlist $wishlist): WishlistId
    {
        $wishlistEntity = $this->buildWishlistEntity($wishlist);

        $this->entityManager->persist($wishlistEntity);

        return $wishlist->getId();
    }

    public function update(Wishlist $wishlist): void
    {
        $this->buildWishlistEntity(
            $wishlist,
            $this->getWishlistEntity($wishlist->getId()->getId())
        );
    }

    public function delete(WishlistId $id): void
    {
        $wishlistEntity = $this->getWishlistEntity($id->getId());

        $this->entityManager->remove($wishlistEntity);
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

    /**
     * @throws \Exception
     */
    public function associateGroupMember(WishlistId $id, WishlistGroupId $wishlistGroupId): void
    {
        $wishlistEntity = $this->getWishlistEntity($id->getId());

        $wishlistGroupEntity = $this->entityManager->getRepository(WishlistGroupEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlistGroupId->getId())]);

        if(!$wishlistGroupEntity) {
            throw new NotFoundException();
        }

        $wishlistGroupMemberEntity = $this->entityManager->getRepository(WishlistGroupMemberEntity::class)
            ->findOneBy([
                'wishlistGroup' => $wishlistGroupEntity,
                'wishlistMember' => $wishlistEntity->getWishlistMember()
            ]);

        if(!$wishlistGroupMemberEntity) {
            throw new NotFoundException();

        }

        $wishlistGroupMemberEntity->setWishlist($wishlistEntity);
    }

    private function getWishlistEntity(string $id): WishlistEntity
    {
        if($this->storePersistEntityService->has($id)) {
            /** @var WishlistEntity $wishlistEntity */
            $wishlistEntity = $this->storePersistEntityService->search($id);

            return $wishlistEntity;
        }

        $wishlistEntity = $this->entityManager->getRepository(WishlistEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($id)]);

        if(!$wishlistEntity) {
            throw new NotFoundException();
        }

        return $wishlistEntity;
    }

    private function buildWishlistEntity(Wishlist $wishlist, WishlistEntity $wishlistEntity = null): WishlistEntity
    {
        $wishlistMemberEntity = $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlist->getMemberId()->getId())]);

        if(!$wishlistMemberEntity) {
            throw new NotFoundException();
        }

        return WishlistDataMapper::fromDomain(
            $wishlist,
            $wishlistMemberEntity,
            $wishlistEntity
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

    private function buildWishlistItemEntity(WishlistItem $wishlistItem, WishlistItemEntity $wishlistItemEntity = null): WishlistItemEntity
    {
        return WishlistItemDataMapper::fromDomain(
            $wishlistItem,
            $this->getWishlistEntity($wishlistItem->getWishlistId()->getId()),
            $wishlistItemEntity
        );
    }
}
