<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistItem;

use App\Infrastructure\Framework\Messenger\Query\QueryHandlerInterface;
use Domain\Wishlist\Port\Query\WishlistItem\GetWishlistItemInterface;
use Domain\Wishlist\Response\WishlistItemResponse;

final readonly class GetWishlistItemHandler implements QueryHandlerInterface
{
    public function __construct(private GetWishlistItemInterface $getWishlistItem)
    {
    }

    public function __invoke(GetWishlistItemQuery $query): WishlistItemResponse
    {
        return $this->getWishlistItem->execute($query->getRequest());
    }
}
