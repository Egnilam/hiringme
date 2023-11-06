<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup\WishlistGroupMember;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember\RemoveWishlistGroupMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupMemberCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistGroupMemberQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\RemoveWishlistGroupMemberRequest;

final readonly class RemoveWishlistGroupMemberUseCase implements RemoveWishlistGroupMemberInterface
{
    public function __construct(
        private WishlistGroupMemberCommandRepositoryInterface $wishlistGroupMemberCommandRepository,
        private WishlistGroupMemberQueryRepositoryInterface $wishlistGroupMemberQueryRepository,
    ) {

    }

    /**
     * @throws DomainException
     */
    public function execute(RemoveWishlistGroupMemberRequest $request): void
    {
        if($this->wishlistGroupMemberQueryRepository->isOwner($request->getWishlistGroupMemberId())) {
            throw new DomainException('Cannot delete group owner');
        }

        $this->wishlistGroupMemberCommandRepository->delete($request->getWishlistGroupMemberId());
    }
}
