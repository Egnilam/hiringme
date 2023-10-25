<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Port\Command\WishlistGroup\CreateWishlistGroupInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\CreateWishlistGroupRequest;

final readonly class CreateWishlistGroupUseCase implements CreateWishlistGroupInterface
{
    public function __construct(
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
        private IdServiceInterface $idService,
    ) {
    }

    public function execute(CreateWishlistGroupRequest $request): void
    {
        $wishlistGroup = new WishlistGroup(
            $this->idService->next(),
            $request->getOwner(),
            $request->getName(),
            $request->getMembers()
        );

        $this->wishlistGroupCommandRepository->create($wishlistGroup);
    }
}
