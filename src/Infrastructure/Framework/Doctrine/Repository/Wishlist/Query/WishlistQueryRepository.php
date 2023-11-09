<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Response\WishlistItemResponse;
use Domain\Wishlist\Response\WishlistResponse;

final class WishlistQueryRepository extends AbstractRepository implements WishlistQueryRepositoryInterface
{
    public function get(GetWishlistRequest $request): WishlistResponse
    {
        $wishlistEntity = $this->entityManager->getRepository(WishlistEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($request->getId())]);

        if(!$wishlistEntity) {
            throw new NotFoundException();
        }

        /** @var array<WishlistItemEntity> $wishlistItemEntities  */
        $wishlistItemEntities = $this->entityManager->getRepository(WishlistItemEntity::class)
            ->createQueryBuilder('wishlist_item')
            ->innerJoin(WishlistEntity::class, 'wishlist', 'WITH', 'wishlist.id = wishlist_item.wishlist')
            ->andWhere('wishlist.uuid = :wishlist')
            ->setParameter('wishlist', IdService::fromStringToBinary($request->getId()))
            ->getQuery()
            ->getResult();

        $wishlistItems = [];
        foreach ($wishlistItemEntities as $wishlistItemEntity) {
            $wishlistItems[] = new WishlistItemResponse(
                $wishlistItemEntity->getStringUuid(),
                $wishlistItemEntity->getLabel(),
                $wishlistItemEntity->getLink(),
                $wishlistItemEntity->getDescription(),
                $wishlistItemEntity->getPriority(),
                $wishlistItemEntity->getPrice()
            );
        }

        return new WishlistResponse(
            $wishlistEntity->getStringUuid(),
            $wishlistEntity->getWishlistMember()->getStringUuid(),
            $wishlistEntity->getName(),
            $wishlistItems,
            'PUBLIC'
        );
    }

    /**
     * @return array<WishlistResponse>
     */
    public function getList(GetListWishlistRequest $request): array
    {
        $wishlistEntities =  $this->entityManager->getRepository(WishlistEntity::class)->findAll();

        $wishlists = [];
        foreach ($wishlistEntities as $wishlistEntity) {
            $wishlists[] = new WishlistResponse(
                $wishlistEntity->getStringUuid(),
                $wishlistEntity->getWishlistMember()->getStringUuid(),
                $wishlistEntity->getName(),
                [],
                'PUBLIC'
            );
        }

        return $wishlists;
    }
}
