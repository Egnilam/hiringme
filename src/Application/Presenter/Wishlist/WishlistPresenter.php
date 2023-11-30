<?php

declare(strict_types=1);

namespace App\Application\Presenter\Wishlist;

use App\Application\View\Wishlist\WishlistView;
use Domain\Wishlist\Response\WishlistItemResponse;
use Domain\Wishlist\Response\WishlistResponse;

final readonly class WishlistPresenter
{
    public function __construct(
        private WishlistItemPresenter $wishlistItemPresenter,
    ) {

    }

    public function present(WishlistResponse $response): WishlistView
    {
        return new WishlistView(
            $response->getName(),
            $response->isOwner(),
            array_map(fn (WishlistItemResponse $item) => $this->wishlistItemPresenter->present($item, $response), $response->getItems()),
        );
    }
}
