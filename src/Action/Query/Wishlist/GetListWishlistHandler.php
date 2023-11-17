<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist;

use App\Infrastructure\Framework\Messenger\Query\QueryHandlerInterface;
use Domain\Wishlist\Port\Query\GetListWishlistInterface;
use Domain\Wishlist\Response\WishlistResponse;

final readonly class GetListWishlistHandler implements QueryHandlerInterface
{
    public function __construct(private GetListWishlistInterface $getListWishlist)
    {
    }

    /**
     * @return array<WishlistResponse>
     */
    public function __invoke(GetListWishlistQuery $query): array
    {
        return $this->getListWishlist->execute($query->getRequest());

    }
}
