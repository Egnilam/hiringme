<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Common\Domain\Exception\DomainException;

final class WishlistBasketItem
{
    private string $id;

    private string $wishlistItemId;

    /**
     * @var array<BasketItem>
     */
    private array $items;

    /**
     * @param array<BasketItem> $items
     * @throws DomainException
     */
    public function __construct(string $id, string $wishlistItemId, array $items)
    {
        $itemCanBeShared = true;
        $memberAttachedToItems = [];
        foreach ($items as $item) {
            if(!$item->isCanBeShared()) {
                if(!$itemCanBeShared) {
                    throw new DomainException('Two peoples cannot take an locked item');
                }
                $itemCanBeShared = false;
            }

            if(isset($memberAttachedToItems[$item->getWishlistMemberId()->getId()])) {
                throw new DomainException('Cannot add this item two times at the same at the same member');
            }
            $memberAttachedToItems[$item->getWishlistMemberId()->getId()] = $item->getWishlistItemId();
        }

        $this->id = $id;
        $this->wishlistItemId = $wishlistItemId;
        $this->items = $items;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWishlistItemId(): string
    {
        return $this->wishlistItemId;
    }

    /**
     * @return array<BasketItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
