<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Symfony\Component\Uid\Uuid;

final class WishlistGroupCommandRepository extends AbstractRepository implements WishlistGroupCommandRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function create(WishlistGroup $wishlistGroup): void
    {
        $ownerEntity = $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => Uuid::fromRfc4122($wishlistGroup->getOwner())]);
        if(!$ownerEntity) {
            throw new \Exception('Not found', 422);
        }

        $wishlistGroupEntity = new WishlistGroupEntity();
        $wishlistGroupEntity
            ->setOwner($ownerEntity)
            ->setName($wishlistGroup->getName());

        $this->entityManager->persist($wishlistGroupEntity);
    }
}
