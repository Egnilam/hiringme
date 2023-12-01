<?php

declare(strict_types=1);

namespace App\Application\Presenter\Wishlist;

use App\Application\Http\Wishlist\WishlistBasketItem\AddMemberToWishlistBasketItemController;
use App\Application\Http\Wishlist\WishlistItem\RemoveItemToWishlistController;
use App\Application\Http\Wishlist\WishlistItem\UpdateItemOfWishlistController;
use App\Application\Presenter\DeleteFormPresenter;
use App\Application\Presenter\ExternalLinkPresenter;
use App\Application\Presenter\LinkPresenter;
use App\Application\View\Wishlist\WishlistItem\WishlistItemView;
use Domain\Wishlist\Response\WishlistItemResponse;
use Domain\Wishlist\Response\WishlistResponse;

final readonly class WishlistItemPresenter
{
    public function __construct(
        private LinkPresenter $linkPresenter,
        private ExternalLinkPresenter $externalLinkPresenter,
        private DeleteFormPresenter $deleteFormPresenter
    ) {

    }

    public function present(WishlistItemResponse $wishlistItem, WishlistResponse $wishlistResponse, ?string $wishlistGroupId): WishlistItemView
    {
        return new WishlistItemView(
            $wishlistItem->getLabel(),
            $wishlistItem->getPrice(),
            $wishlistItem->getPriority(),
            $wishlistItem->getDescription(),
            $wishlistItem->getLink() ? $this->externalLinkPresenter->present($wishlistItem->getLabel(), $wishlistItem->getLink()) : null,
            $this->deleteFormPresenter->present(
                $wishlistItem->getId(),
                RemoveItemToWishlistController::NAME,
                RemoveItemToWishlistController::getRequestParams($wishlistResponse->getId(), $wishlistItem->getId())
            ),
            $this->linkPresenter->present(
                'Update item',
                UpdateItemOfWishlistController::NAME,
                UpdateItemOfWishlistController::getRequestParams($wishlistResponse->getId(), $wishlistItem->getId())
            ),
            $this->linkPresenter->present(
                'Add item',
                AddMemberToWishlistBasketItemController::NAME,
                AddMemberToWishlistBasketItemController::getRequestParams($wishlistResponse->getId(), $wishlistItem->getId(), $wishlistGroupId)
            ),
            'remove',
            $wishlistResponse->isOwner(),
            $wishlistItem->getBasketItems()
        );
    }
}
