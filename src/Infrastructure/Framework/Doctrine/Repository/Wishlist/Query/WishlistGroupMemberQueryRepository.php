<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Domain\Wishlist\Repository\Query\WishlistGroupMemberQueryRepositoryInterface;

class WishlistGroupMemberQueryRepository extends AbstractRepository implements WishlistGroupMemberQueryRepositoryInterface
{
    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function emailIsAvailable(string $email, string $wishlistGroupId): bool
    {
        return !$this->entityManager->getRepository(WishlistGroupMemberEntity::class)
            ->createQueryBuilder('wishlist_group_member')
            ->select('COUNT(wishlist_group_member.id)')
            ->innerJoin(WishlistGroupEntity::class, 'wishlist_group', 'WITH', 'wishlist_group.id = wishlist_group_member.wishlistGroup')
            ->andWhere('wishlist_group.uuid = :wishlistGroupId')
            ->setParameter('wishlistGroupId', IdService::fromStringToBinary($wishlistGroupId))
            ->innerJoin(WishlistMemberEntity::class, 'wishlist_member', 'WITH', 'wishlist_member.id = wishlist_group_member.wishlistMember')
            ->andWhere('wishlist_member.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function pseudonymIsAvailable(string $pseudonym, string $wishlistGroupId): bool
    {
        return !$this->entityManager->getRepository(WishlistGroupMemberEntity::class)
            ->createQueryBuilder('wishlist_group_member')
            ->select('COUNT(wishlist_group_member.id)')
            ->andWhere('wishlist_group_member.pseudonym = :pseudonym')
            ->setParameter('pseudonym', $pseudonym)
            ->innerJoin(WishlistGroupEntity::class, 'wishlist_group', 'WITH', 'wishlist_group.id = wishlist_group_member.wishlistGroup')
            ->andWhere('wishlist_group.uuid = :wishlistGroupId')
            ->setParameter('wishlistGroupId', IdService::fromStringToBinary($wishlistGroupId))
            ->getQuery()
            ->getSingleScalarResult();

    }

    public function isOwner(string $id): bool
    {
        return (bool)$this->entityManager->getRepository(WishlistGroupMemberEntity::class)
            ->findOneBy([
                'uuid' => IdService::fromStringToBinary($id),
                'owner' => true
            ]);

    }
}
