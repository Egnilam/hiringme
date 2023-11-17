<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\ValueObject\Email;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\WishlistGroup\AddMemberToWishlistGroupInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistGroupQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\AddMemberToWishlistGroupRequest;
use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\BuildWishlistGroupMemberRequest;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;
use Domain\Wishlist\UseCase\Command\WishlistGroup\WishlistGroupMember\BuildWishlistGroupMember;

final readonly class AddMemberToWishlistGroupUseCase implements AddMemberToWishlistGroupInterface
{
    public function __construct(
        private BuildWishlistGroupMember $buildWishlistGroupMember,
        private WishlistGroupQueryRepositoryInterface $wishlistGroupQueryRepository,
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
    ) {

    }

    /**
     * @throws EmailFormatException|DomainException
     */
    public function execute(AddMemberToWishlistGroupRequest $request): string
    {
        $wishlistGroupId = new WishlistGroupId($request->getWishlistGroupId());

        $wishlistGroupResponse = $this->wishlistGroupQueryRepository->get(new GetWishlistGroupRequest($request->getWishlistGroupId()));

        $wishlistGroupMember = $this->buildWishlistGroupMember->execute(
            new BuildWishlistGroupMemberRequest(
                $wishlistGroupId,
                $request->getPseudonym(),
                $request->getEmail(),
                $request->isOwner()
            )
        );

        $wishlistGroupMembers[] = $wishlistGroupMember;
        foreach ($wishlistGroupResponse->getMembers() as $member) {
            $wishlistGroupMembers[] = WishlistGroupMember::createFromResponse($member, $wishlistGroupId);
        }

        new WishlistGroup(
            $wishlistGroupId,
            $wishlistGroupResponse->getName(),
            $wishlistGroupMembers,
        );

        return $this->wishlistGroupCommandRepository->addMember($wishlistGroupMember);
    }
}
