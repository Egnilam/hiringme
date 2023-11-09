<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Domain\Model\VisibilityEnum;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\Model\WishlistItem;
use Domain\Wishlist\Domain\ValueObject\LinkItem;
use Domain\Wishlist\Domain\ValueObject\PriceItem;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\UpdateItemOfWishlistInterface;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\UpdateItemOfWishlistRequest;
use Domain\Wishlist\Request\Query\GetWishlistRequest;

final readonly class UpdateItemOfWishlistUseCase implements UpdateItemOfWishlistInterface
{
    public function __construct(
        private WishlistCommandRepositoryInterface $wishlistCommandRepository,
        private WishlistQueryRepositoryInterface $wishlistQueryRepository
    ) {

    }

    /**
     * @throws DomainException
     */
    public function execute(UpdateItemOfWishlistRequest $request): void
    {
        $wishlistId = new WishlistId($request->getWishlistId());

        $wishlistResponse = $this->wishlistQueryRepository->get(new GetWishlistRequest($request->getWishlistId()));

        $wishlistItems = [];
        foreach ($wishlistResponse->getItems() as $item) {
            $wishlistItems[$item->getId()] = WishlistItem::createFromResponse($item, $wishlistId);
        }

        if(!isset($wishlistItems[$request->getId()])) {
            throw new NotFoundException();
        }

        unset($wishlistItems[$request->getId()]);

        $wishlistItem = new WishlistItem(
            $request->getId(),
            $wishlistId,
            $request->getLabel(),
            $request->getLink() ? new LinkItem($request->getLink()) : null,
            $request->getDescription(),
            $request->getPriority(),
            $request->getPrice() ? new PriceItem($request->getPrice()) : null,
        );
        $wishlistItems[] = $wishlistItem;

        $wishlist = new Wishlist(
            $wishlistId,
            new WishlistMemberId($wishlistResponse->getOwner()),
            $wishlistResponse->getName(),
            $wishlistItems,
            VisibilityEnum::from($wishlistResponse->getVisibility())
        );

        $this->wishlistCommandRepository->updateItem($wishlistItem);
    }
}
