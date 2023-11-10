<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\DataMapper\Command\WishlistGroupDataMapper;
use App\Infrastructure\Framework\Doctrine\DataMapper\Command\WishlistGroupMemberDataMapper;
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
        $wishlistGroupEntity = $this->buildWishlistGroupEntity($wishlistGroup);

        $this->entityManager->persist($wishlistGroupEntity);

        foreach ($wishlistGroup->getMembers() as $member) {
            $wishlistGroupMemberEntity = $this->buildWishlistGroupMemberEntity(
                $member,
                $wishlistGroupEntity,
            );

            $this->entityManager->persist($wishlistGroupMemberEntity);
        }

        return $wishlistGroup->getId();
    }

    public function update(WishlistGroup $wishlistGroup): void
    {
        $this->buildWishlistGroupEntity(
            $wishlistGroup,
            $this->getWishlistGroupEntity($wishlistGroup->getId()->getId())
        );
    }

    public function delete(WishlistGroupId $id): void
    {
        $wishlistGroupEntity = $this->getWishlistGroupEntity($id->getId());

        $this->entityManager->remove($wishlistGroupEntity);
    }

    public function addMember(WishlistGroupMember $wishlistGroupMember): string
    {
        $wishlistGroupEntity = $this->getWishlistGroupEntity($wishlistGroupMember->getWishlistGroupId()->getId());

        $wishlistGroupMemberEntity = $this->buildWishlistGroupMemberEntity(
            $wishlistGroupMember,
            $wishlistGroupEntity
        );

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

    private function getWishlistGroupEntity(string $id): WishlistGroupEntity
    {
        $wishlistGroupEntity = $this->entityManager->getRepository(WishlistGroupEntity::class)
            ->findOneBy(['uuid' => IdService::fromString($id)]);

        if(!$wishlistGroupEntity) {
            throw new NotFoundException();
        }

        return $wishlistGroupEntity;
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

    private function buildWishlistGroupEntity(WishlistGroup $wishlistGroup, ?WishlistGroupEntity $wishlistGroupEntity = null): WishlistGroupEntity
    {
        return WishlistGroupDataMapper::fromDomain(
            $wishlistGroup,
            $wishlistGroupEntity
        );
    }

    private function buildWishlistGroupMemberEntity(
        WishlistGroupMember $wishlistGroupMember,
        WishlistGroupEntity $wishlistGroupEntity,
        ?WishlistGroupMemberEntity $wishlistGroupMemberEntity = null
    ): WishlistGroupMemberEntity {
        return WishlistGroupMemberDataMapper::fromDomain(
            $wishlistGroupMember,
            $wishlistGroupEntity,
            $this->getWishlistMemberEntity($wishlistGroupMember->getWishlistMemberId()),
            $wishlistGroupMemberEntity
        );
    }
}
