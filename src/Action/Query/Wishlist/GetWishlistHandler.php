<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist;

use App\Infrastructure\Framework\Messenger\Query\QueryHandlerInterface;
use Domain\Wishlist\Port\Query\GetWishlistInterface;
use Domain\Wishlist\Response\WishlistResponse;

final readonly class GetWishlistHandler implements QueryHandlerInterface
{
    public function __construct(private GetWishlistInterface $getWishlist)
    {
    }

    public function __invoke(GetWishlistQuery $query): WishlistResponse
    {
        return $this->getWishlist->execute($query->getRequest());
    }
}
