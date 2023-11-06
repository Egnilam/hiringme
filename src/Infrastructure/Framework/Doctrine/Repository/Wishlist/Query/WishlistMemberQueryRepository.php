<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Repository\Query\WishlistMemberQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;

final class WishlistMemberQueryRepository extends AbstractRepository implements WishlistMemberQueryRepositoryInterface
{
    /**
     * @throws \Exception|NotFoundException
     */
    public function get(GetWishlistMemberRequest $request): WishlistMemberResponse
    {
        $entityRequest = $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->createQueryBuilder('wishlist_member');

        if($request->getUserId()) {
            $entityRequest
                ->innerJoin(UserEntity::class, 'user', 'WITH', 'user.id = wishlist_member.user')
                ->andWhere('user.uuid = :userId')
                ->setParameter('userId', IdService::fromStringToBinary($request->getUserId()));
        }

        if($request->getEmail()) {
            $entityRequest
                ->andWhere('wishlist_member.email = :email')
                ->setParameter('email', $request->getEmail());
        }

        /** @var array<WishlistMemberEntity> $wishlistMemberEntities */
        $wishlistMemberEntities = $entityRequest->getQuery()->getResult();

        if(count($wishlistMemberEntities) === 0) {
            throw new NotFoundException();
        } elseif (count($wishlistMemberEntities) > 1) {
            throw new \Exception('To many found', 422);
        }

        $wishlistMemberEntity = $wishlistMemberEntities[0];

        return new WishlistMemberResponse(
            $wishlistMemberEntity->getStringUuid(),
            $wishlistMemberEntity->getUser()?->getStringUuid(),
            $wishlistMemberEntity->getEmail(),
            $wishlistMemberEntity->isRegistered()
        );
    }
}
