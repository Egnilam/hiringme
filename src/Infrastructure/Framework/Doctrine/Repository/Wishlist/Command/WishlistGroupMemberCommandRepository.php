<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Repository\Command\WishlistGroupMemberCommandRepositoryInterface;

final class WishlistGroupMemberCommandRepository extends AbstractRepository implements WishlistGroupMemberCommandRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function create(WishlistGroupMember $wishlistGroupMember): string
    {
        $wishlistGroupMemberEntity = new WishlistGroupMemberEntity();
        $wishlistGroupMemberEntity
            ->setStringUuid($wishlistGroupMember->getId())
            ->setWishlistMember($this->getWishlistMemberEntity($wishlistGroupMember->getWishlistMemberId()))
            ->setWishlistGroup($this->getWishlistGroupEntity($wishlistGroupMember->getWishlistGroupId()))
            ->setPseudonym($wishlistGroupMember->getPseudonym());

        $this->entityManager->persist($wishlistGroupMemberEntity);

        return $wishlistGroupMemberEntity->getStringUuid();
    }

    /**
     * @throws \Exception
     */
    private function getWishlistGroupEntity(string $uuid): WishlistGroupEntity
    {
        if($this->storePersistEntityService->has($uuid)) {
            /** @var WishlistGroupEntity $wishlistGroupEntity */
            $wishlistGroupEntity = $this->storePersistEntityService->search($uuid);

            return $wishlistGroupEntity;
        }

        return $this->entityManager->getRepository(WishlistGroupEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($uuid)]) ?? throw new \Exception('Not found', 422);
    }

    /**
     * @throws \Exception
     */
    private function getWishlistMemberEntity(string $uuid): WishlistMemberEntity
    {
        if($this->storePersistEntityService->has($uuid)) {
            /** @var WishlistMemberEntity $wishlistMemberEntity */
            $wishlistMemberEntity = $this->storePersistEntityService->search($uuid);

            return $wishlistMemberEntity;
        }

        return $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($uuid)]) ?? throw new \Exception('Not found', 422);
    }
}
