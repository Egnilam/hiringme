<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup\WishlistGroupMember;

use Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupMemberCommandRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

class CreateWishlistGroupMemberUseCase implements CreateWishlistGroupMemberInterface
{
    public function __construct(private WishlistGroupMemberCommandRepositoryInterface $wishlistGroupMemberCommandRepository) {

    }

    public function execute(CreateWishlistGroupMemberRequest $request): void
    {
        $this->wishlistGroupMemberCommandRepository->create($request);
    }
}