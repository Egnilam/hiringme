<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Entity\WishlistMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use App\Infrastructure\Framework\Uuid\IdService;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;

final class WishlistGroupCommandRepository extends AbstractRepository implements WishlistGroupCommandRepositoryInterface
{
    public function create(WishlistGroup $wishlistGroup): WishlistGroupId
    {
        $wishlistGroupEntity = new WishlistGroupEntity();
        $wishlistGroupEntity
            ->setStringUuid($wishlistGroup->getId()->getId())
            ->setName($wishlistGroup->getName());

        $this->entityManager->persist($wishlistGroupEntity);

        foreach ($wishlistGroup->getMembers() as $member) {
            $wishlistGroupMemberEntity = new WishlistGroupMemberEntity();
            $wishlistGroupMemberEntity
                ->setStringUuid($member->getId())
                ->setWishlistMember($this->getWishlistMemberEntity($member->getWishlistMemberId()))
                ->setWishlistGroup($wishlistGroupEntity)
                ->setPseudonym($member->getPseudonym())
                ->setOwner($member->isOwner());

            $this->entityManager->persist($wishlistGroupMemberEntity);
        }


        return $wishlistGroup->getId();
    }

    public function delete(WishlistGroupId $id): void
    {
        $wishlistGroupEntity = $this->entityManager->getRepository(WishlistGroupEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($id->getId())]);

        if(!$wishlistGroupEntity) {
            throw new NotFoundException();
        }

        $this->entityManager->remove($wishlistGroupEntity);
    }

    public function addMember(WishlistGroupMember $wishlistGroupMember): string
    {
        $wishlistGroupEntity = $this->entityManager->getRepository(WishlistGroupEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlistGroupMember->getWishlistGroupId()->getId())]);

        if(!$wishlistGroupEntity) {
            throw new NotFoundException();
        }

        $wishlistGroupMemberEntity = new WishlistGroupMemberEntity();
        $wishlistGroupMemberEntity
            ->setStringUuid($wishlistGroupMember->getId())
            ->setWishlistMember($this->getWishlistMemberEntity($wishlistGroupMember->getWishlistMemberId()))
            ->setWishlistGroup($wishlistGroupEntity)
            ->setPseudonym($wishlistGroupMember->getPseudonym())
            ->setOwner($wishlistGroupMember->isOwner());

        $this->entityManager->persist($wishlistGroupMemberEntity);

        return $wishlistGroupMember->getId();
    }

    public function removeMember(string $wishlistGroupMemberId): void
    {
        $wishlistGroupMemberEntity = $this->entityManager->getRepository(WishlistGroupMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($wishlistGroupMemberId)]);

        if(!$wishlistGroupMemberEntity) {
            throw new NotFoundException();
        }

        $this->entityManager->remove($wishlistGroupMemberEntity);
    }

    /**
     * @throws NotFoundException
     */
    private function getWishlistMemberEntity(WishlistMemberId $id): WishlistMemberEntity
    {
        if($this->storePersistEntityService->has($id->getId())) {
            /** @var WishlistMemberEntity $wishlistMemberEntity */
            $wishlistMemberEntity = $this->storePersistEntityService->search($id->getId());

            return $wishlistMemberEntity;
        }

        return $this->entityManager->getRepository(WishlistMemberEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($id->getId())]) ?? throw new NotFoundException();
    }
}
