<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistMemberBasket;

use App\Infrastructure\Framework\Messenger\Query\QueryHandlerInterface;
use Domain\Wishlist\Port\Query\WishlistMemberBasket\GetWishlistMemberBasketInterface;
use Domain\Wishlist\Response\WishlistMemberBasketResponse;

final readonly class GetWishlistMemberBasketHandler implements QueryHandlerInterface
{
    public function __construct(private GetWishlistMemberBasketInterface $getWishlistMemberBasket)
    {
    }

    public function __invoke(GetWishlistMemberBasketQuery $query): WishlistMemberBasketResponse
    {
        return $this->getWishlistMemberBasket->execute($query->getRequest());
    }
}
