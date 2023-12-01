<?php

declare(strict_types=1);

namespace App\Application\View\Wishlist;

use App\Application\View\LinkView;
use App\Application\View\ViewInterface;

final readonly class ListWishlistView implements ViewInterface
{
    /**
     * @param array<WishlistView>  $wishlists
     */
    public function __construct(
        private string $pageTitle,
        private string $title,
        private array $wishlists,
        private LinkView $actionCreate
    ) {
    }

    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getActionCreate(): LinkView
    {
        return $this->actionCreate;
    }

    /**
     * @return array<WishlistView>
     */
    public function getWishlists(): array
    {
        return $this->wishlists;
    }
}
