<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Wishlist\Domain\Model\WishlistMember;
use Domain\Wishlist\Repository\Command\WishlistMemberCommandRepositoryInterface;
use Symfony\Component\Uid\Uuid;

final class WishlistMemberCommandRepository extends AbstractRepository implements WishlistMemberCommandRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function register(WishlistMember $wishlistMember): void
    {
        if($wishlistMember->getUserId()) {
            $user = $this->getUserEntity($wishlistMember->getUserId());
        }

        $wishlistMemberEntity = new WishlistMemberEntity();
        $wishlistMemberEntity
            ->setEmail($wishlistMember->getEmail())
            ->setUser($user ?? null)
            ->setRegistered($wishlistMember->isRegistered());

        $this->entityManager->persist($wishlistMemberEntity);
    }

    /**
     * @throws \Exception
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

        return $user ?? throw new \Exception('User not found', 422);
    }
}
