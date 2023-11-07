<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\CreateWishlistInterface;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;
use Domain\Wishlist\Request\Command\CreateWishlistRequest;

final readonly class CreateWishlistUseCase implements CreateWishlistInterface
{
    public function __construct(
        private IdServiceInterface $idService,
        private WishlistCommandRepositoryInterface $wishlistCommandRepository,
    ) {
    }

    public function execute(CreateWishlistRequest $request): WishlistId
    {
        $wishlistId = new WishlistId($this->idService->next());
        $owner = new WishlistMemberId($request->getOwner());

        $wishlist = new Wishlist(
            $wishlistId,
            $owner,
            $request->getName(),
            [],
            $request->getVisibility()
        );

        dump($wishlist);

        return $this->wishlistCommandRepository->create($wishlist);
    }
}
