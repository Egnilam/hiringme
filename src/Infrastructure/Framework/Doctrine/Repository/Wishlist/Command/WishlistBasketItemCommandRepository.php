<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\BasketEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Domain\Model\BasketItem;
use Domain\Wishlist\Repository\Command\WishlistBasketItemCommandRepositoryInterface;

final class WishlistBasketItemCommandRepository extends AbstractRepository implements WishlistBasketItemCommandRepositoryInterface
{
    public function addItem(BasketItem $basketItem): string
    {
        $wishlistMemberEntity = $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($basketItem->getWishlistMemberId()->getId())]);

        if($wishlistMemberEntity === null) {
            throw new NotFoundException();
        }

        $wishlistItemEntity = $this->entityManager->getRepository(WishlistItemEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($basketItem->getWishlistItemId())]);

        if($wishlistItemEntity === null) {
            throw new NotFoundException();
        }

        if($basketItem->getWishlistGroupId()) {
            $wishlistGroupEntity = $this->entityManager->getRepository(WishlistGroupEntity::class)
                ->findOneBy(['uuid' => IdService::fromString($basketItem->getWishlistGroupId()->getId())]);

            if($wishlistGroupEntity === null) {
                throw new NotFoundException();
            }
        }

        $wishlistMemberBasketEntity = new BasketEntity();
        $wishlistMemberBasketEntity
            ->setWishlistMember($wishlistMemberEntity)
            ->setWishlistItem($wishlistItemEntity)
            ->setWishlistGroup($wishlistGroupEntity ?? null)
            ->setVisibleName($basketItem->isMemberVisible())
            ->setCanBeShared($basketItem->isCanBeShared());

        $this->entityManager->persist($wishlistMemberBasketEntity);

        return $wishlistMemberBasketEntity->getStringUuid();
    }
}
