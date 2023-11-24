<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\BasketEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Wishlist\Repository\Query\WishlistBasketItemQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\WishlistBasketItem\GetWishlistBasketItemRequest;
use Domain\Wishlist\Response\WishlistBasketItemResponse;

final class WishlistBasketItemQueryRepository extends AbstractRepository implements WishlistBasketItemQueryRepositoryInterface
{
    public function get(GetWishlistBasketItemRequest $request): array
    {
        /** @var array<BasketEntity> $items */
        $items = $this->entityManager->getRepository(BasketEntity::class)
            ->createQueryBuilder('basket')
            ->innerJoin(WishlistItemEntity::class, 'wishlist_item', 'WITH', 'wishlist_item.id = basket.wishlistItem')
            ->andWhere('wishlist_item.uuid = :wishlistItem')
            ->setParameter('wishlistItem', IdService::fromStringToBinary($request->getWishlistItemId()))
            ->getQuery()
            ->getResult();

        $wishlistItemBaskets = [];
        foreach ($items as $item) {
            $wishlistGroupMember = null;
            if($request->getWishlistGroupId()) {
                $wishlistGroupMember = $this->entityManager->getRepository(WishlistGroupMemberEntity::class)
                    ->findOneBy([
                        'wishlist' => $item->getWishlistItem()->getWishlist(),
                        'wishlistMember' => $item->getWishlistMember()
                    ]);
            }

            if($wishlistGroupMember) {
                $memberName = $wishlistGroupMember->getPseudonym();
            } else {
                $memberName = $item->getWishlistMember()->getEmail() ?? $item->getWishlistMember()->getStringUuid();
            }

            $wishlistItemBaskets[] = new WishlistBasketItemResponse(
                $item->getStringUuid(),
                $item->getWishlistItem()->getStringUuid(),
                $item->getWishlistMember()->getStringUuid(),
                $memberName,
                $item->isVisibleName(),
                $item->isCanBeShared()
            );
        }

        return $wishlistItemBaskets;
    }
}
