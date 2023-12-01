<?php

declare(strict_types=1);

namespace App\Application\Presenter\Wishlist;

use App\Application\Http\Wishlist\CreateWishlistController;
use App\Application\Presenter\LinkPresenter;
use App\Application\View\Wishlist\ListWishlistView;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class ListWishlistPresenter
{
    public function __construct(
        private LinkPresenter $linkPresenter,
        private WishlistPresenter $wishlistPresenter,
        private TranslatorInterface $translator,
    ) {

    }

    /**
     * @param array<WishlistResponse> $wishlists
     */
    public function present(array $wishlists): ListWishlistView
    {
        return new ListWishlistView(
            $this->translator->trans('ui.wishlist.list.title'),
            $this->translator->trans('ui.wishlist.list.title'),
            array_map(fn (WishlistResponse $wishlist) => $this->wishlistPresenter->present($wishlist), $wishlists),
            $this->linkPresenter->present('ui.wishlist.create', CreateWishlistController::NAME)
        );
    }
}
