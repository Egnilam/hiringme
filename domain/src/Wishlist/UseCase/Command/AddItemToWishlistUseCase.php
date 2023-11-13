<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\VisibilityEnum;
use Domain\Wishlist\Domain\Model\Wishlist;
use Domain\Wishlist\Domain\Model\WishlistItem;
use Domain\Wishlist\Domain\ValueObject\LinkItem;
use Domain\Wishlist\Domain\ValueObject\PriceItem;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\AddItemToWishlistInterface;
use Domain\Wishlist\Repository\Command\WishlistCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\AddItemToWishlistRequest;
use Domain\Wishlist\Request\Query\GetWishlistRequest;

final readonly class AddItemToWishlistUseCase implements AddItemToWishlistInterface
{
    public function __construct(
        private IdServiceInterface $idService,
        private WishlistCommandRepositoryInterface $wishlistCommandRepository,
        private WishlistQueryRepositoryInterface $wishlistQueryRepository,
    ) {
    }

    /**
     * @throws DomainException
     */
    public function execute(AddItemToWishlistRequest $request): string
    {
        $wishlistId = new WishlistId($request->getWishlistId());

        $wishlistResponse = $this->wishlistQueryRepository->get(new GetWishlistRequest($request->getWishlistId()));

        $wishlistItem = new WishlistItem(
            $this->idService->next(),
            $wishlistId,
            $request->getLabel(),
            $request->getLink() ? new LinkItem($request->getLink()) : null,
            $request->getDescription(),
            $request->getPriority(),
            $request->getPrice() ? new PriceItem($request->getPrice()) : null,
        );

        $wishlistItems[] = $wishlistItem;
        foreach ($wishlistResponse->getItems() as $item) {
            $wishlistItems[$item->getId()] = WishlistItem::createFromResponse($item, $wishlistId);
        }

        new Wishlist(
            $wishlistId,
            new WishlistMemberId($wishlistResponse->getOwner()),
            $wishlistResponse->getName(),
            [],
            $wishlistItems,
            VisibilityEnum::from($wishlistResponse->getVisibility())
        );

        return $this->wishlistCommandRepository->addItem($wishlistItem);
    }
}
