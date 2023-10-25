<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Wishlist\Repository\Command\WishlistGroupMemberCommandRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

final class WishlistGroupMemberCommandRepository extends AbstractRepository implements WishlistGroupMemberCommandRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function create(CreateWishlistGroupMemberRequest $request): void
    {
        $wishlistGroupMember = new WishlistGroupMemberEntity();
        $wishlistGroupMember
            ->setWishlistMember($this->getWishlistMemberEntity($request->getWishlistMemberId()))
            ->setWishlistGroup($this->getWishlistGroupEntity($request->getWishlistGroupId()))
            ->setPseudonym($request->getPseudonym());

        $this->entityManager->persist($wishlistGroupMember);
    }

    /**
     * @throws \Exception
     */
    private function getWishlistGroupEntity(string $uuid): WishlistGroupEntity {
        if($this->storePersistEntityService->has($uuid)){
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
    private function getWishlistMemberEntity(string $uuid): WishlistMemberEntity {
        if($this->storePersistEntityService->has($uuid)){
            /** @var WishlistMemberEntity $wishlistMemberEntity */
            $wishlistMemberEntity = $this->storePersistEntityService->search($uuid);

            return $wishlistMemberEntity;
        }

        return $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($uuid)]) ?? throw new \Exception('Not found', 422);
    }
}