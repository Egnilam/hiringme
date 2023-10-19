<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Wishlist\Domain\Model\WishlistMember;
use Domain\Wishlist\Repository\Command\WishlistMemberCommandRepositoryInterface;
use Symfony\Component\Uid\Uuid;

final class WishlistMemberCommandRepository extends AbstractRepository implements WishlistMemberCommandRepositoryInterface
{
    public function register(WishlistMember $wishlistMember): void
    {
        if($wishlistMember->getUserId()) {
            $user = $this->entityManager->getRepository(UserEntity::class)
                ->findOneBy(['uuid' => Uuid::fromRfc4122($wishlistMember->getUserId())]);
        }

        $wishlistMemberEntity = new WishlistMemberEntity();
        $wishlistMemberEntity
            ->setEmail($wishlistMember->getEmail())
            ->setUser($user ?? null)
            ->setRegistered($wishlistMember->isRegistered());

        $this->entityManager->persist($wishlistMemberEntity);
    }
}
