<?php

declare(strict_types=1);

namespace App\Application\Presenter\Wishlist;

use App\Application\Http\Wishlist\DeleteWishlistController;
use App\Application\Http\Wishlist\ShowWishlistController;
use App\Application\Http\Wishlist\UpdateWishlistController;
use App\Application\Http\Wishlist\WishlistItem\AddItemToWishlistController;
use App\Application\Presenter\DeleteFormPresenter;
use App\Application\Presenter\LinkPresenter;
use App\Application\View\Wishlist\WishlistView;
use Domain\Wishlist\Response\WishlistItemResponse;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class WishlistPresenter
{
    public function __construct(
        private TranslatorInterface $translator,
        private WishlistItemPresenter $wishlistItemPresenter,
        private LinkPresenter $linkPresenter,
        private DeleteFormPresenter $deleteFormPresenter,
    ) {

    }

    public function present(WishlistResponse $wishlist, ?string $wishlistGroupId = null): WishlistView
    {
        return new WishlistView(
            $wishlist->getName(),
            $wishlist->isOwner(),
            $this->translator->trans(sprintf('wishlist.visibility.ENUM.%s', $wishlist->getVisibility())),
            array_map(fn (WishlistItemResponse $item) => $this->wishlistItemPresenter->present($item, $wishlist, $wishlistGroupId), $wishlist->getItems()),
            $wishlist->getGroups(),
            $this->linkPresenter->present(
                'show',
                ShowWishlistController::NAME,
                ShowWishlistController::getRequestParams($wishlist->getId())
            ),
            $this->linkPresenter->present(
                'ui.wishlist.update',
                UpdateWishlistController::NAME,
                UpdateWishlistController::getRequestParams($wishlist->getId())
            ),
            $this->deleteFormPresenter->present(
                $wishlist->getId(),
                DeleteWishlistController::NAME,
                DeleteWishlistController::getRequestParams($wishlist->getId())
            ),
            $this->linkPresenter->present(
                'ui.wishlist.item.add',
                AddItemToWishlistController::NAME,
                AddItemToWishlistController::getRequestParams($wishlist->getId())
            )
        );
    }
}
