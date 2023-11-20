<?php

declare(strict_types=1);

namespace App\Application\View\Wishlist;

use App\Application\View\LinkItemView;
use App\Application\View\ViewInterface;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Component\Translation\TranslatableMessage;

class ListWishlistView implements ViewInterface
{
    private TranslatableMessage $title;

    private LinkItemView $createWishlist;

    /**
     * @param array<WishlistResponse>  $wishlists
     * @param LinkItemView $createWishlist
     */
    public function __construct(
        private readonly array $wishlists,
        LinkItemView $createWishlist
    ) {
        $this->title = new TranslatableMessage('ui.wishlist.list.title');
        $this->createWishlist = $createWishlist;
    }

    /**
     * @return array<WishlistResponse>
     */
    public function getWishlists(): array
    {
        return $this->wishlists;
    }

    public function getTitle(): TranslatableMessage
    {
        return $this->title;
    }

    public function getCreateWishlist(): LinkItemView
    {
        return $this->createWishlist;
    }
}
