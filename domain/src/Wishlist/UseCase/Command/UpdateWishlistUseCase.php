<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\Model\WishlistItem;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\UpdateWishlistInterface;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\UpdateWishlistRequest;
use Domain\Wishlist\Request\Query\GetWishlistRequest;

final readonly class UpdateWishlistUseCase implements UpdateWishlistInterface
{
    public function __construct(
        private WishlistQueryRepositoryInterface $wishlistQueryRepository,
        private WishlistCommandRepositoryInterface $wishlistCommandRepository,
    ) {
    }

    /**
     * @throws DomainException
     */
    public function execute(UpdateWishlistRequest $request): void
    {
        $wishlistId = new WishlistId($request->getId());
        $owner = new WishlistMemberId($request->getOwner());

        $wishlistResponse = $this->wishlistQueryRepository->get(new GetWishlistRequest($wishlistId->getId()));

        $wishlistItems = [];
        foreach ($wishlistResponse->getItems() as $item) {
            $wishlistItems[] = WishlistItem::createFromResponse($item, $wishlistId);
        }

        $wishlist = new Wishlist(
            $wishlistId,
            $owner,
            $request->getName(),
            $wishlistItems,
            $request->getVisibility()
        );

        $this->wishlistCommandRepository->update($wishlist);
    }
}
