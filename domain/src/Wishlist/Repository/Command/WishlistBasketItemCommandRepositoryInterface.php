<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Command;

use Domain\Wishlist\Domain\Model\BasketItem;

interface WishlistBasketItemCommandRepositoryInterface
{
    public function addItem(BasketItem $basketItem): string;
}
