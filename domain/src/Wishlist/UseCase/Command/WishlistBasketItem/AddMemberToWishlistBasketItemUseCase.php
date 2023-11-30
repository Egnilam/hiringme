<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistBasketItem;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Domain\Model\BasketItem;
use Domain\Wishlist\Domain\Model\WishlistBasketItem;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\WishlistBasketItem\AddMemberToWishlistBasketItemInterface;
use Domain\Wishlist\Repository\Command\WishlistBasketItemCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistBasketItemQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistBasketItem\AddMemberToWishlistBasketItemRequest;
use Domain\Wishlist\Request\Query\WishlistBasketItem\GetWishlistBasketItemRequest;

final readonly class AddMemberToWishlistBasketItemUseCase implements AddMemberToWishlistBasketItemInterface
{
    public function __construct(
        private WishlistBasketItemCommandRepositoryInterface $wishlistItemBasketCommandRepository,
        private WishlistBasketItemQueryRepositoryInterface $wishlistItemBasketQueryRepository
    ) {

    }

    /**
     * @throws DomainException
     */
    public function execute(AddMemberToWishlistBasketItemRequest $request): string
    {
        $wishlistItemId = $request->getWishlistItemId();
        $wishlistMemberId = new WishlistMemberId($request->getWishlistMemberId());
        $wishlistGroupId = $request->getWishlistGroupId() ? new WishlistGroupId($request->getWishlistGroupId()) : null;

        $basketItem = new BasketItem(
            $wishlistItemId,
            $wishlistMemberId,
            $wishlistGroupId,
            $request->isVisibleName(),
            $request->isCanBeShared()
        );
        $basketItems = [$basketItem];

        $items = $this->wishlistItemBasketQueryRepository->get(new GetWishlistBasketItemRequest($wishlistItemId));
        foreach ($items as $item) {
            $basketItems[] = new BasketItem(
                $item->getWishlistItemId(),
                new WishlistMemberId($item->getWishlistMemberId()),
                $item->getWishlistGroupId() ? new WishlistGroupId($item->getWishlistGroupId()) : null,
                $item->isVisibleName(),
                $item->isCanBeShared()
            );
        }

        new WishlistBasketItem(
            $wishlistItemId,
            $request->getWishlistItemId(),
            $basketItems
        );

        return $this->wishlistItemBasketCommandRepository->addItem($basketItem);
    }
}
