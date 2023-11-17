<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Port\Command\WishlistGroup\CreateWishlistGroupInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\CreateWishlistGroupRequest;
use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\BuildWishlistGroupMemberRequest;
use Domain\Wishlist\UseCase\Command\WishlistGroup\WishlistGroupMember\BuildWishlistGroupMember;

final readonly class CreateWishlistGroupUseCase implements CreateWishlistGroupInterface
{
    public function __construct(
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
        private IdServiceInterface                      $idService,
        private BuildWishlistGroupMember $buildWishlistGroupMember
    ) {
    }

    /**
     * @throws DomainException
     */
    public function execute(CreateWishlistGroupRequest $request): WishlistGroupId
    {
        $wishlistGroupId = new WishlistGroupId($this->idService->next());

        $wishlistGroupMembers = [];
        foreach ($request->getMembers() as $member) {
            $wishlistGroupMembers[] = $this->buildWishlistGroupMember->execute(
                new BuildWishlistGroupMemberRequest(
                    $wishlistGroupId,
                    $member->getPseudonym(),
                    $member->getEmail(),
                    $member->isOwner()
                )
            );
        }

        $wishlistGroup = new WishlistGroup(
            $wishlistGroupId,
            $request->getName(),
            $wishlistGroupMembers
        );

        return $this->wishlistGroupCommandRepository->create($wishlistGroup);
    }
}
