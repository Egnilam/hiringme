<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Port\Command\WishlistGroup\CreateWishlistGroupInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\CreateWishlistGroupRequest;

final readonly class CreateWishlistGroupUseCase implements CreateWishlistGroupInterface
{
    public function __construct(
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
    ) {
    }

    public function execute(CreateWishlistGroupRequest $createWishlistGroupRequest): void
    {
        $wishlistGroup = new WishlistGroup(
            'id',
            $createWishlistGroupRequest->getOwner(),
            $createWishlistGroupRequest->getName(),
            $createWishlistGroupRequest->getMembers()
        );

        $this->wishlistGroupCommandRepository->create($wishlistGroup);
    }
}
