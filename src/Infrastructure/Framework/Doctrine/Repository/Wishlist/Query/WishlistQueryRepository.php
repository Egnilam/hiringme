<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
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
        if($this->storePersistEntityService->has($request->getId())) {
            /** @var WishlistEntity $wishlistEntity */
            $wishlistEntity = $this->storePersistEntityService->search($request->getId());

        } else {
            $wishlistEntity = $this->entityManager->getRepository(WishlistEntity::class)
                ->findOneBy(['uuid' => IdService::fromString($request->getId())]);
        }

        if(!$wishlistEntity) {
            throw new NotFoundException();
        }


        if(
            $request->hasOption(GetWishlistRequest::OPT_LOAD_ITEMS)
            && $request->getOptionValue(GetWishlistRequest::OPT_LOAD_ITEMS)
        ) {
            $items = $this->getWishlistItems($request->getId());
        }
        return new WishlistResponse(
            $wishlistEntity->getStringUuid(),
            $wishlistEntity->getWishlistMember()->getStringUuid(),
            $wishlistEntity->getName(),
            $this->getWishlistGroups($wishlistEntity),
            $items ?? [],
            $wishlistEntity->getVisibility()
        );
    }

    /**
     * @return array<WishlistResponse>
     */
    public function getList(GetListWishlistRequest $request): array
    {
        $wishlistRequest = $this->entityManager->getRepository(WishlistEntity::class)
            ->createQueryBuilder('wishlist');

        if($request->getWishlistMemberId()) {
            $wishlistRequest
                ->innerJoin(WishlistMemberEntity::class, 'wishlist_member', 'WITH', 'wishlist_member.id = wishlist.wishlistMember')
                ->andWhere('wishlist_member.uuid = :wishlistMember')
                ->setParameter('wishlistMember', IdService::fromStringToBinary($request->getWishlistMemberId()));
        }

        /** @var array<WishlistEntity> $wishlistEntities */
        $wishlistEntities = $wishlistRequest->getQuery()->getResult();

        $wishlists = [];
        foreach ($wishlistEntities as $wishlistEntity) {
            $wishlists[] = new WishlistResponse(
                $wishlistEntity->getStringUuid(),
                $wishlistEntity->getWishlistMember()->getStringUuid(),
                $wishlistEntity->getName(),
                [],
                $this->getWishlistItems($wishlistEntity->getStringUuid()),
                $wishlistEntity->getVisibility()
            );
        }

        return $wishlists;
    }

    /**
     * @return array<WishlistItemResponse>
     */
    private function getWishlistItems(string $wishlistId): array
    {
        /** @var array<WishlistItemEntity> $wishlistItemEntities  */
        $wishlistItemEntities = $this->entityManager->getRepository(WishlistItemEntity::class)
            ->createQueryBuilder('wishlist_item')
            ->innerJoin(WishlistEntity::class, 'wishlist', 'WITH', 'wishlist.id = wishlist_item.wishlist')
            ->andWhere('wishlist.uuid = :wishlist')
            ->setParameter('wishlist', IdService::fromStringToBinary($wishlistId))
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

        return $wishlistItems;
    }

    /**
     * @return array<string>
     */
    private function getWishlistGroups(WishlistEntity $wishlistEntity): array
    {
        $wishlistGroupMembers = $this->entityManager->getRepository(WishlistGroupMemberEntity::class)
            ->findBy(['wishlist' => $wishlistEntity]);

        $groups = [];
        foreach ($wishlistGroupMembers as $wishlistGroupMember) {
            $groups[] = $wishlistGroupMember->getWishlistGroup()->getStringUuid();
        }

        return $groups;
    }
}
