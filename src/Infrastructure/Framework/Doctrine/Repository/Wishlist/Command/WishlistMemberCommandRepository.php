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
        if($wishlistMember->getUserId()) {
            $user = $this->getUserEntity($wishlistMember->getUserId());
        }

        $wishlistMemberEntity = new WishlistMemberEntity();
        $wishlistMemberEntity
            ->setStringUuid($wishlistMember->getId())
            ->setEmail($wishlistMember->getEmail())
            ->setUser($user ?? null)
            ->setRegistered($wishlistMember->isRegistered());

        $this->entityManager->persist($wishlistMemberEntity);

        return $wishlistMemberEntity->getStringUuid();
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
