<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Port\Command\WishlistGroup\UpdateWishlistGroupInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistGroupQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\UpdateWishlistGroupRequest;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;

final readonly class UpdateWishlistGroupUseCase implements UpdateWishlistGroupInterface
{
    public function __construct(
        private WishlistGroupQueryRepositoryInterface $wishlistGroupQueryRepository,
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
    ) {

    }

    /**
     * @throws EmailFormatException
     * @throws DomainException
     */
    public function execute(UpdateWishlistGroupRequest $request): void
    {
        $wishlistGroupId = new WishlistGroupId($request->getId());

        $wishlistGroupResponse = $this->wishlistGroupQueryRepository->get(new GetWishlistGroupRequest($wishlistGroupId->getId()));

        $members = [];
        foreach ($wishlistGroupResponse->getMembers() as $member) {
            $members[] = WishlistGroupMember::createFromResponse($member, $wishlistGroupId);
        }

        $wishlistGroup = new WishlistGroup(
            $wishlistGroupId,
            $request->getName(),
            $members
        );

        $this->wishlistGroupCommandRepository->update($wishlistGroup);
    }
}
