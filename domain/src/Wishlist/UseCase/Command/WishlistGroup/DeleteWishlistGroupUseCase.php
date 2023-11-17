<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Port\Command\WishlistGroup\DeleteWishlistGroupInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Request\Command\DeleteWishlistRequest;

final readonly class DeleteWishlistGroupUseCase implements DeleteWishlistGroupInterface
{
    public function __construct(
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
    ) {
    }

    public function execute(DeleteWishlistRequest $request): void
    {
        $wishlistGroupId = new WishlistGroupId($request->getId());

        $this->wishlistGroupCommandRepository->delete($wishlistGroupId);
    }
}
