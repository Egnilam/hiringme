<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Wishlist\Repository\Query\WishlistGroupQueryRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\GetListWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;
use Symfony\Component\Uid\Uuid;

final class WishlistGroupQueryRepository extends AbstractRepository implements WishlistGroupQueryRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getList(GetListWishlistGroupRequest $request): array
    {
        $entityRequest = $this->entityManager->getRepository(WishlistGroupEntity::class)
            ->createQueryBuilder('wishlist_group');

        if($request->getWishlistMemberId()) {
            $entityRequest
                ->innerJoin(WishlistGroupMemberEntity::class, 'wishlist_group_member', 'WITH', 'wishlist_group_member.wishlistGroup = wishlist_group.id')
                ->innerJoin(WishlistMemberEntity::class, 'wishlist_member', 'WITH', 'wishlist_member.id = wishlist_group_member.wishlistMember')
                ->andWhere('wishlist_member.uuid = :wishlistMemberId')
                ->setParameter('wishlistMemberId', IdService::fromStringToBinary($request->getWishlistMemberId()))
                ->andWhere('wishlist_group_member.owner = :owner')
                ->setParameter('owner', true);
        }

        /** @var array<WishlistGroupEntity> $wishlistGroupEntities */
        $wishlistGroupEntities = $entityRequest->getQuery()->getResult();

        $wishlistGroupResponses = [];
        foreach ($wishlistGroupEntities as $wishlistGroupEntity) {
            $wishlistGroupResponses[] = new WishlistGroupResponse(
                $wishlistGroupEntity->getStringUuid(),
                $wishlistGroupEntity->getName(),
            );
        }

        return $wishlistGroupResponses;
    }
}
