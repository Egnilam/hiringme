<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Domain\Model\VisibilityEnum;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\AssociateGroupMemberToWishlistInterface;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\AssociateGroupMemberToWishlistRequest;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;

final readonly class AssociateGroupMemberMemberToWishlistUseCase implements AssociateGroupMemberToWishlistInterface
{
    public function __construct(
        private GetClaimantWishlistMemberIdInterface $getClaimantWishlistMemberId,
        private WishlistQueryRepositoryInterface $wishlistQueryRepository,
        private WishlistCommandRepositoryInterface $wishlistCommandRepository,
    ) {

    }

    /**
     * @throws DomainException
     */
    public function execute(AssociateGroupMemberToWishlistRequest $request): void
    {
        $wishlistId = new WishlistId($request->getWishlistId());

        $wishlistGroupId = new WishlistGroupId($request->getWishlistGroupId());
        $wishlistMemberClaimantId = $this->getClaimantWishlistMemberId->getWishlistMemberId();

        $wishlistResponse = $this->wishlistQueryRepository->get(
            new GetWishlistRequest($request->getWishlistId()),
            $wishlistMemberClaimantId
        );

        $groups[] = $wishlistGroupId;
        foreach ($wishlistResponse->getGroups() as $group) {
            $groups[] = new WishlistGroupId($group);
        }

        new Wishlist(
            $wishlistId,
            new WishlistMemberId($wishlistResponse->getWishlistMemberId()),
            $wishlistResponse->getName(),
            $groups,
            [],
            VisibilityEnum::from($wishlistResponse->getVisibility())
        );

        $this->wishlistCommandRepository->associateGroupMember(
            $wishlistId,
            $wishlistGroupId
        );
    }
}
