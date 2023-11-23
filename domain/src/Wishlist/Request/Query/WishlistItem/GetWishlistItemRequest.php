<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query\WishlistItem;

final readonly class GetWishlistItemRequest
{
    public const OPT_LOAD_BASKET_ITEMS = 'load_basket_items';

    public function __construct(
        private string $id,
        private array $options = []
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
