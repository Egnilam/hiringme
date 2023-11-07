<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\ValueObject\Email;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\WishlistGroup\RemoveMemberToWishlistGroupInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistGroupQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\RemoveMemberToWishlistGroupRequest;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;

final readonly class RemoveMemberToWishlistGroupUseCase implements RemoveMemberToWishlistGroupInterface
{
    public function __construct(
        private WishlistGroupQueryRepositoryInterface $wishlistGroupQueryRepository,
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
    ) {

    }

    /**
     * @throws DomainException
     */
    public function execute(RemoveMemberToWishlistGroupRequest $request): void
    {
        $wishlistGroupId = new WishlistGroupId($request->getWishlistGroupId());

        $wishlistGroupResponse = $this->wishlistGroupQueryRepository->get(new GetWishlistGroupRequest($request->getWishlistGroupId()));

        $wishlistGroupMembers = [];
        foreach ($wishlistGroupResponse->getMembers() as $member) {
            $wishlistGroupMembers[$member->getId()] = new WishlistGroupMember(
                $member->getId(),
                $member->getPseudonym(),
                $member->getEmail() ? new Email($member->getEmail()) : null,
                new WishlistMemberId($member->getWishlistMemberId()),
                $wishlistGroupId,
                $member->isOwner()
            );
        }

        unset($wishlistGroupMembers[$request->getWishlistGroupMemberId()]);

        new WishlistGroup(
            $wishlistGroupId,
            $wishlistGroupResponse->getName(),
            $wishlistGroupMembers,
        );

        $this->wishlistGroupCommandRepository->removeMember($request->getWishlistGroupMemberId());
    }
}
