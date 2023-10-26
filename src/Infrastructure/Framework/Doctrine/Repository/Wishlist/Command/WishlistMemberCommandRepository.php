<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Domain\Model\WishlistMember;
use Domain\Wishlist\Repository\Command\WishlistMemberCommandRepositoryInterface;

final class WishlistMemberCommandRepository extends AbstractRepository implements WishlistMemberCommandRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function register(WishlistMember $wishlistMember): string
    {
        $wishlistMemberEntity = $this->createWishlistMemberEntity($wishlistMember);

        $this->entityManager->persist($wishlistMemberEntity);

        return $wishlistMemberEntity->getStringUuid();
    }

    public function update(WishlistMember $wishlistMember): string
    {
        $wishlistMemberEntity = $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlistMember->getId())]);

        if($wishlistMemberEntity === null) {
            throw new NotFoundException();
        }

        $wishlistMemberEntity = $this->createWishlistMemberEntity($wishlistMember, $wishlistMemberEntity);

        return $wishlistMemberEntity->getStringUuid();
    }

    private function createWishlistMemberEntity(WishlistMember $wishlistMember, ?WishlistMemberEntity $wishlistMemberEntity = null): WishlistMemberEntity
    {
        if($wishlistMember->getUserId()) {
            $user = $this->getUserEntity($wishlistMember->getUserId());
        }

        $wishlistMemberEntity = $wishlistMemberEntity ?? new WishlistMemberEntity();
        $wishlistMemberEntity
            ->setStringUuid($wishlistMember->getId())
            ->setEmail($wishlistMember->getEmail())
            ->setUser($user ?? null)
            ->setRegistered($wishlistMember->isRegistered());

        return $wishlistMemberEntity;
    }

    /**
     * @throws NotFoundException
     */
    private function getUserEntity(string $uuid): UserEntity
    {
        if(!$this->storePersistEntityService->has($uuid)) {
            /** @var UserEntity $user */
            $user = $this->storePersistEntityService->search($uuid);

            return $user;
        }

        $user = $this->entityManager->getRepository(UserEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($uuid)]);

        return $user ?? throw new NotFoundException();
    }
}
