<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistMember;

use App\Infrastructure\Framework\Messenger\Query\QueryHandlerInterface;
use Domain\Wishlist\Port\Query\WishlistMember\GetWishlistMemberInterface;
use Domain\Wishlist\Response\WishlistMemberResponse;

final readonly class GetWishlistMemberHandler implements QueryHandlerInterface
{
    public function __construct(private GetWishlistMemberInterface $getWishlistMember)
    {
    }

    public function __invoke(GetWishlistMemberQuery $query): WishlistMemberResponse
    {
        return $this->getWishlistMember->execute($query->getRequest());
    }
}
