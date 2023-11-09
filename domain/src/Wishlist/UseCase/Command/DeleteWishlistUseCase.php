<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Port\Command\DeleteWishlistInterface;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;
use Domain\Wishlist\Request\Command\DeleteWishlistRequest;

final readonly class DeleteWishlistUseCase implements DeleteWishlistInterface
{
    public function __construct(
        private WishlistCommandRepositoryInterface $wishlistCommandRepository,
    ) {
    }

    public function execute(DeleteWishlistRequest $request): void
    {
        $wishlistId = new WishlistId($request->getId());

        $this->wishlistCommandRepository->delete($wishlistId);
    }
}
