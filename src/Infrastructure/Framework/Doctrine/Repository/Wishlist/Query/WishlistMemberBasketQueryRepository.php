<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\BasketEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Repository\Query\WishlistMemberBasketQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\WishlistMemberBasket\GetWishlistMemberBasketRequest;
use Domain\Wishlist\Response\WishlistMemberBasketItemResponse;
use Domain\Wishlist\Response\WishlistMemberBasketResponse;

final class WishlistMemberBasketQueryRepository extends AbstractRepository implements WishlistMemberBasketQueryRepositoryInterface
{
    public function get(GetWishlistMemberBasketRequest $request): WishlistMemberBasketResponse
    {
        /** @var array<BasketEntity> $basketEntities */
        $basketEntities = $this->entityManager->getRepository(BasketEntity::class)
            ->createQueryBuilder('basket')
            ->innerJoin(WishlistMemberEntity::class, 'wishlist_member', 'WITH', 'wishlist_member.id = basket.wishlistMember')
            ->andWhere('wishlist_member.uuid = :wishlistMember')
            ->setParameter('wishlistMember', IdService::fromStringToBinary($request->getWishlistMemberId()))
            ->getQuery()
            ->getResult();

        $wishlistMemberBasketItems = [];
        foreach ($basketEntities as $basketEntity) {
            if($basketEntity->getWishlistGroup()) {
                $wishlistGroupMemberEntity = $this->entityManager->getRepository(WishlistGroupMemberEntity::class)
                    ->findOneBy([
                        'wishlistGroup' => $basketEntity->getWishlistGroup(),
                        'wishlistMember' => $basketEntity->getWishlistItem()->getWishlist()->getWishlistMember()
                    ]);

                if($wishlistGroupMemberEntity === null) {
                    throw new NotFoundException();
                }

                $pseudonym = $wishlistGroupMemberEntity->getPseudonym();
            }

            $wishlistMemberBasketItems[] = new WishlistMemberBasketItemResponse(
                $basketEntity->getStringUuid(),
                $basketEntity->getWishlistItem()->getStringUuid(),
                $basketEntity->getWishlistItem()->getLabel(),
                $basketEntity->getWishlistItem()->getWishlist()->getWishlistMember()->getStringUuid(),
                $pseudonym ?? $basketEntity->getWishlistItem()->getWishlist()->getWishlistMember()->getStringUuid(),
                $basketEntity->getWishlistItem()->getWishlist()->getStringUuid(),
                $basketEntity->getWishlistItem()->getWishlist()->getName(),
                $basketEntity->getWishlistGroup()?->getStringUuid(),
                $basketEntity->getWishlistGroup()?->getName()
            );
        }

        return new WishlistMemberBasketResponse($wishlistMemberBasketItems);
    }
}
