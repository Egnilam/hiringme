<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Query\QueryHandlerInterface;
use Domain\Wishlist\Port\Query\WishlistGroup\GetWishlistGroupInterface;
use Domain\Wishlist\Response\WishlistGroupResponse;

final readonly class GetWishlistGroupHandler implements QueryHandlerInterface
{
    public function __construct(private GetWishlistGroupInterface $getWishlistGroup)
    {
    }

    public function __invoke(GetWishlistGroupQuery $query): WishlistGroupResponse
    {
        return $this->getWishlistGroup->execute($query->getRequest());
    }
}
