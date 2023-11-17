<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Domain\Model\PriorityEnum;
use Domain\Wishlist\Domain\Model\VisibilityEnum;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\Model\WishlistItem;
use Domain\Wishlist\Domain\ValueObject\LinkItem;
use Domain\Wishlist\Domain\ValueObject\PriceItem;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\RemoveItemToWishlistInterface;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\RemoveItemToWishlistRequest;
use Domain\Wishlist\Request\Query\GetWishlistRequest;

final readonly class RemoveItemToWishlistUseCase implements RemoveItemToWishlistInterface
{
    public function __construct(
        private WishlistQueryRepositoryInterface $wishlistQueryRepository,
        private WishlistCommandRepositoryInterface $wishlistCommandRepository,
    ) {

    }

    /**
     * @throws DomainException
     */
    public function execute(RemoveItemToWishlistRequest $request): void
    {
        $wishlistId = new WishlistId($request->getWishlistId());
        $wishlistResponse = $this->wishlistQueryRepository->get(new GetWishlistRequest($wishlistId->getId()));

        $wishlistItems = [];
        foreach ($wishlistResponse->getItems() as $item) {
            $wishlistItems[$item->getId()] = WishlistItem::createFromResponse($item, $wishlistId);
        }

        unset($wishlistItems[$request->getWishlistItemId()]);

        new Wishlist(
            $wishlistId,
            new WishlistMemberId($wishlistResponse->getOwner()),
            $wishlistResponse->getName(),
            [],
            $wishlistItems,
            VisibilityEnum::from($wishlistResponse->getVisibility())
        );

        $this->wishlistCommandRepository->removeItem($request->getWishlistItemId());
    }
}
